<?php

class CsvImportTest extends TestCase
{
    public function testCsvImportSucceeded()
    {
        $this->seeInDatabase('restaurants', ['name' => 'Classic Pizza']);
    }
}