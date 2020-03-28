$(document).ready(function(){

    
    $('#nepali_year_start_date_bs').nepaliDatePicker({
            npdMonth: true,
		    npdYear: true,
		    npdYearCount: 10,
		    ndpEnglishInput: 'englishDateStart'
		});
		$('#nepali_year_end_date_bs').nepaliDatePicker({
            npdMonth: true,
		    npdYear: true,
		    npdYearCount: 10,
		    ndpEnglishInput: 'englishDateEnd'
        });
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


