document.addEventListener('DOMContentLoaded', deleteHabit, false);

function deleteHabit(e)
{
    let elements = document.querySelectorAll('.delete-habit-form');

    elements.forEach(element => {
        element.addEventListener('submit', function(event) {
            event.preventDefault();
            if(confirm('Do you really want to delete this habit?')) {
                console.log('enstra');
            }
          });
    });
}
