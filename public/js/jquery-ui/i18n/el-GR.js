jQuery(function($) {
	$.datepicker.regional["gr"] = {
        "altFormat": "dd.mm.yy",
        "closeText": "Κλείσιμο",
        "currentText": "Σήμερα",
        "dateFormat": "dd.mm.yy",
        "dayNames": ["Κυριακή", "Δευτέρα", "Τρίτη", "Τετάρτη", "Πέμπτη", "Παρασκευή", "Σάββατο"],
        "dayNamesMin": ["Κυ", "Δε", "Τρ", "Τε", "Πε", "Πα", "Σα"],
        "dayNamesShort": ["Κυ", "Δε", "Τρ", "Τε", "Πε", "Πα", "Σα"],
        "firstDay": 1,
        "monthNames": ["Ιανουάριος", "Φεβρουάριος", "Μάρτιος", "Απρίλιος", "Μάιος", "Ιούνιος", "Ιούλιος", "Αύγουστος", "Σεπτέμβριος", "Οκτώβριος", "Νοέμβριος", "Δεκέμβριος"],
        "monthNamesShort": ["Ιαν", "Φλε", "Μαρ", "Απρ", "Μαι", "Ιουν", "Ιουλ", "Αυγ", "Σεπ", "Οκτ", "Νοε", "Δεκ"],
        "nextText": "Επόμενο",
        "prevText": "Πίσω"
    };

	$.datepicker.setDefaults($.datepicker.regional["gr"]);
});
