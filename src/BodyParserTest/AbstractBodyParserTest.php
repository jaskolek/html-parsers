<?php
declare(strict_types=1);


namespace App\BodyParserTest;


use App\OfferRecord;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Base class for the parser test. It implements some useful methods for testing, especially "assertOfferRecordsEquals"
 * Each test should extend this one
 *
 * Class AbstractBodyParserTest
 * @package App\BodyParserTest
 */
abstract class AbstractBodyParserTest implements BodyParserTestInterface
{
    /**
     * Method that compares actualOfferRecord with expectedOfferRecords.
     * All the differences found are shown in the output
     *
     * @param OfferRecord $actualOfferRecord
     * @param OfferRecord $expectedOfferRecord
     */
    public function assertOfferRecordsEqual(OfferRecord $actualOfferRecord, OfferRecord $expectedOfferRecord): void
    {
        $output = new ConsoleOutput();
        $input = new ArgvInput();
        $io = new SymfonyStyle($input, $output);

        $actualRecordArray = $actualOfferRecord->toArray();
        $expectedRecordArray = $expectedOfferRecord->toArray();

        $io->section('Actual record details');
        dump($actualRecordArray);
        $io->newLine(3);
        $io->section('Expected record details');
        dump($expectedRecordArray);
        $io->newLine(3);

        $missingList = [];
        $differentList = [];
        $this->getMissingFieldsRecursive($actualRecordArray, $expectedRecordArray, $missingList, $differentList, '');

        if (count($missingList) > 0) {
            $io->warning('Missing fields in actual record.');
            $io->listing($missingList);
        }
        if (count($differentList) > 0) {
            $io->warning('Fields have different values.');
            foreach ($differentList as [$path, $actualValue, $expectedValue]) {
                if (is_array($actualValue)) {
                    $actualValue = 'Array[' . implode(',', $actualValue) . ']';
                }
                if (is_array($expectedValue)) {
                    $expectedValue = 'Array[' . implode(',', $expectedValue) . ']';
                }
                $io->writeln($path . ' = "' . $actualValue . '" (' . gettype($actualValue) . '). Should be: "' . $expectedValue . '" (' . gettype($expectedValue) . ')');
            }
        }

        if (count($missingList) + count($differentList) > 0) {
            $io->error(get_class($this) . ' - Actual record is different than expected');
        } else {
            $io->success('Test passed. Actual record equals expected record');
        }
    }


    /**
     * @param array $actualArray
     * @param array $expectedArray
     * @param array $missingList
     * @param array $differentList
     * @param string $path
     */
    private function getMissingFieldsRecursive(array $actualArray, array $expectedArray, array &$missingList, array &$differentList, string $path): void
    {
        foreach ($expectedArray as $key => $value) {
            if (!array_key_exists($key, $actualArray)) {
                $missingList[] = $path . '["' . $key . '"]';
            } else if (is_array($value)) {
                if ($this->isAssociativeArray($value)) {
                    $this->getMissingFieldsRecursive($actualArray[$key], $value, $missingList, $differentList, $path . '["' . $key . '"]');
                } else {
                    foreach ($value as $arrayValue) {
                        if (is_array($actualArray[$key])) {
                            if (!in_array($arrayValue, $actualArray[$key], true)) {
                                $missingList[] = $path . '["' . $key . '"][] = ' . $arrayValue;
                            }
                        } else {
                            $differentList[] = [$path . '["' . $key . '"]', $actualArray[$key], $value];
                        }
                    }
                }
            } else if ($actualArray[$key] !== $value) {
                $differentList[] = [$path . '["' . $key . '"]', $actualArray[$key], $value];
            }
        }
    }

    /**
     * @param array $array
     * @return bool
     */
    private function isAssociativeArray(array $array): bool
    {
        return array_values($array) !== $array;
    }
}