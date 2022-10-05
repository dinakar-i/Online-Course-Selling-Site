ClassicEditor
    .create(document.querySelector('#body'))
    .catch(error => {
        console.error(error);
    });

$('#SelectAllEmbed').click(function () {
    console.log('1');
});

