/*

/!*_______________________________________________________________  ADD VARIATION  _____________________*!/
$('#add_variation').on('click', () => {
    $('#variation_row .form-row').clone().appendTo($('#variation_row .col'));
});




/!*_______________________________________________________________  ADD VARIATION  _____________________*!/
$('.variation#variation_attribute_s2').select2({
    placeholder: 'Select an attribute',
    width: 'resolve',
    theme: 'classic',
    tags: true,
    tokenSeparators: [',', ' ']
});
$('.variation#values_s2').select2({
    multiple: true,
    width: 'resolve',
    theme: 'classic',
    tags: true,
    tokenSeparators: [',', ' ']
});



/!*_______________________________________________________________  COUPONS  _____________________*!/
$('#categories_s2').select2({
    allowClear: true,
    width: 'resolve',
    theme: 'classic',
});
*/
