$(function(){

	
    // $('#nepali_year_start_date_bs').nepaliDatePicker({
    //         npdMonth: true,
	// 	    npdYear: true,
	// 	    npdYearCount: 10,
	// 	    ndpEnglishInput: 'englishDateStart'
	// 	});
	// 	$('#nepali_year_end_date_bs').nepaliDatePicker({
    //         npdMonth: true,
	// 	    npdYear: true,
	// 	    npdYearCount: 10,
	// 	    ndpEnglishInput: 'englishDateEnd'
	// 	});
		$('#nepali_year_start_date_bs').jDatepicker({separator: '-', ADelm: 'englishDateStart'});
		$('#nepali_year_end_date_bs').jDatepicker({separator: '-', ADelm: 'englishDateEnd'});
		
});


function confirmDelete()
{
	if(confirm('Are you sure to delete this item?') == true) {
		return true;
	}
	else {
		return false;
	}
}


