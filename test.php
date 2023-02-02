<?php 
require 'vendor/autoload.php';
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;



$column_array = [];
$row_array = [];
$path = 'test.xlsx'; //file_path
# open the file
$reader = ReaderEntityFactory::createXLSXReader();
$reader->open($path);
# read each cell of each row of each sheet
foreach ($reader->getSheetIterator() as $sheet) {
    foreach ($sheet->getRowIterator() as $row) {
        foreach ($row->getCells() as $cell) {
            $i++;
            if ($i < 14): // the number of columns is 13
                $column_array[] = $cell;
            else:
                $row_array[] = $cell;
            endif;
    }
}
}




$array_index = 0;
$column_number = 0;
for ($row_number=0; $row_number < sizeof($row_array); $row_number++) { 
    
    $data[$array_index][$column_array[$column_number]->getValue()] = $row_array[$row_number]->getValue();
    if($column_number == 12) { // 13 columns in excel
        $column_number = 0;
        $array_index++;
        continue; 
    }
    $column_number++;
}

print_r($data);
$reader->close();

?>