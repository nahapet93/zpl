<?php

use SmartDato\Zpl\Enums\CompressionType;
use SmartDato\Zpl\Fields\Graphics\GraphicField;

test('ASCII encoded graphic field', function () {
    $compression = CompressionType::ASCII;
    $binaryByteCount = 768;
    $graphicFieldCount = 384;
    $bytesPerRow = 8;
    $data =
    '00003FFFC0000000000600000FF0000000180200C01F8000003008000000600000204080440D10000041080000000C000082420000CC02000084000200010200
     0100200001008000010040000000800002000FF80000010006003F84003E01800C036F8200E100C01402307101FE01202878000E030000A07106020001000150
     4201FC0000007C50821000000106C090A438000001800010A466001E0040115084A183C80070103042107009C044382060104E0800803A20300C40E00700F840
     380FE03C0003D8001A047021F83C588004027E2021845880020227E021047880020141F82187F8800100C07FFFFFF88001004047FFFFF88000803040FFFFF880
     00C00880419970800060078001117080001241C00012608000089038C237C08000060401FFF8008000011080000020000000C21040E0044000003863C0010840
     000006060000104000000180380080400000006000000080000000180000008000000007800001000000000038000600000000000380180000000000003FC000';

    $gf = new GraphicField(
        $compression,
        $binaryByteCount,
        $graphicFieldCount,
        $bytesPerRow,
        $data
    );
    $gf->at(0, 0);

    $expected = "^FO0,0^GF{$compression->value},{$binaryByteCount},{$graphicFieldCount},{$bytesPerRow},{$data}^FS";

    expect($gf->render())->toBe($expected);
});
