$(document).ready(function () {
    $(".landlord-editable").click(function() {
        makeInput($(this).find("span"));
    });

    $(".landlord-editable").focusout(function() {
        destructInputTag($(this));
    });

    $(".landlord-editable").change(function () {
        submitChangedData($(this));
    });
});

//List of tags that will require a certain input type
var boolInputs   = ["avail", "water", "heat", "trash", "elec"];
var textInputs   = ["parking"];
var numberInputs = ["price", "bed", "bath"];
var inputType = {bool : 1, text : 2, number : 3};

//Takes the selected tag, and turns it into an <input> with the appropriate type and value
function makeInput(toBeMadeInput) {
    var type       = determineInputType(toBeMadeInput.attr("class"));
    var inputValue = toBeMadeInput.text();
    var newTag     = constructInputTag(inputValue, type);
    $(toBeMadeInput).replaceWith(newTag);
}

//Based on the tag's class, return the type of input as an inputType enum
function determineInputType(classOfObject) {
    if ($.inArray(classOfObject, boolInputs) !== -1) {
        return inputType.bool;
    } else if ($.inArray(classOfObject, numberInputs) !== -1) {
        return inputType.number;
    } else if ($.inArray(classOfObject, textInputs) !== -1) {
        return inputType.text;
    } else {
        throw new Error("Could not determine input type");
    }
}

//Returns the string of tag(s) that make up the <input> for a tag
function constructInputTag(value, type) {
    if (type === inputType.number) {
        return "<input type=\"number\" name=\"changedField\" min=\"1\" max=\"10000\" value=\"" + value + "\">";
    } else if (type === inputType.text) {
        return "<input type=\"text\" name=\"changedField\" value=\"" + value + "\">";
    } else if (type === inputType.bool) {

        if (value === "YES") {
            return "<select name=\"changedField\">\n\t<option value=\"true\" selected>YES</option>\n\t" +
                "<option value=\"false\">NO</option>\n</select>";
        } else if (value === "AVAILABLE") {
            return "<select name=\"changedField\">\n\t<option value=\"true\" selected>AVAILABLE</option>\n\t" +
                "<option value=\"false\">UNAVAILABLE</option>\n</select>";
        } else if (value === "UNAVAILABLE") {
            return "<select name=\"changedField\">\n\t<option value=\"true\">AVAILABLE</option>\n\t" +
                "<option value=\"false\" selected>UNAVAILABLE</option>\n</select>";
        } else {
            return "<select name=\"changedField\">\n\t<option value=\"true\">YES</option>\n\t" +
                "<option value=\"false\" selected>NO</option>\n</select>";
        }
    } else {
        throw new Error("Invalid input type");
    }
}

//Gets the value out of an <input> or <select>
function getChangedValue(tag) {
    if (tag.find("select").length > 0) {
        return tag.find(":selected").attr("value");
    } else {
        return tag.find("input").val();
    }
}

//Converts YES or NO to 1 or 0
function textToBool(text) {
    if (text === "true") {
        return 1;
    } else {
        return 0;
    }
}

function getColumnFromClass(tag) {
    //Returns group 1 of a regex that matches text behind "value-outer-"
    return tag.attr("class").match(/value-outer-([a-z]*)/)[1];
}

function submitChangedData(tag) {
    var newData = getChangedValue(tag);
    if (newData === "true" || newData === "false") {
        newData = textToBool(newData);
    }
    var tagClass     = getColumnFromClass(tag);
    var insertColumn = convertClassToColumn(tagClass);
    var propertyID   = getPropertyID();

    $.ajax({url: "update_property.php",
            type: "POST",
            data: {'data': newData, 'type': insertColumn, 'id': propertyID}});
}

function convertClassToColumn(classToConvert) {
    switch (classToConvert) {
        case ("avail"):
            return "is_available";
        case ("price"):
            return "monthly_cost";
        case ("bed"):
            return "beds";
        case ("bath"):
            return "baths";
        case ("water"):
            return "water_included";
        case ("elec"):
            return "electricity_included";
        case ("heat"):
            return "heat_included";
        case ("trash"):
            return "trash_included";
        case ("parking"):
            return "parking";
        default:
            throw new Error("Unknown class")
    }
}

function getPropertyID() {
    var url = window.location.href;
    return url.substr(url.indexOf("id=")+3);
}

//Reverts an <input> or <select> to whatever it was before
function destructInputTag(tag) {
    if (tag.find("input").length > 0) {
        var innerInput = tag.find("input");
        var dataType = tag.attr("class").match(/value-outer-([a-z]*)/)[1];

        innerInput.replaceWith("<span class=\"" + dataType + "\">" + innerInput.val() + "</span>");
    } else {
        var innerSelect = tag.find("select");
        var selectedValue = innerSelect.find(":selected").text();
        var dataType = tag.attr("class").match(/value-outer-([a-z]*)/)[1];

        if (dataType === "avail") {
            if (selectedValue === "AVAILABLE") {
                tag.attr("style", "color: green; font-weight: bold");
                innerSelect.replaceWith("<span class=\"" + dataType + "\">AVAILABLE</span>");
            } else {
                tag.attr("style", "color: red; font-weight: bold");
                innerSelect.replaceWith("<span class=\"" + dataType + "\">UNAVAILABLE</span>");
            }
        }
        else {
            innerSelect.replaceWith("<span class=\"" + dataType + "\">" + selectedValue + "</span>");
        }
    }
}