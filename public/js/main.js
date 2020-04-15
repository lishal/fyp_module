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
	// $('.nepali-calendar').nepaliDatePicker({
    	
	// 	npdMonth: true,
	//     npdYear: true,
	//     npdYearCount: 10,
	//     ndpEnglishInput: 'englishDate'
	// });
		$('.nepali-calendar').jDatepicker({separator: '-', ADelm: 'englishDate'});
		$('#nepali_year_start_date_bs').jDatepicker({separator: '-', ADelm: 'englishDateStart'});
		$('#nepali_year_end_date_bs').jDatepicker({separator: '-', ADelm: 'englishDateEnd'});
		$('#fromDate').jDatepicker({separator: '-', ADelm: 'englishFromDate'});
		$('#toDate').jDatepicker({separator: '-', ADelm: 'englishToDate'});
		
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


