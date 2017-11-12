<?php
    $db = new PDO("mysql:dbname=rent_smart;host=localhost","root");

    $data = $_POST['data'];
    $type = $_POST['type'];
    $id   = $_POST['id'];

    switch ($type) {
        case "monthly_cost":
            $type = "monthly_cost";
            break;
        case "is_available":
            $type = "is_available";
            break;
        case "beds":
            $type = "beds";
            break;
        case "baths":
            $type = "baths";
            break;
        case "water_included":
            $type = "water_included";
            break;
        case "electricity_included":
            $type = "electricity_included";
            break;
        case "heat_included":
            $type = "heat_included";
            break;
        case "trash_included":
            $type = "trash_included";
            break;
        case "parking":
            $type = "parking";
            break;
        default:
            throw new Error("Invalid data type");
            break;
    }

    $update = $db -> prepare("UPDATE properties SET $type = :dataval
                                        WHERE property_id = :id;");
    $update -> execute(['dataval' => $data, 'id' => $id]);
