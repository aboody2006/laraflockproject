$(document).ready(function ()
{
   $('select#message_template').on('change', function ()
   {
       var template = $('option:selected', this).text();

       $('#message').val(template);
   });
});