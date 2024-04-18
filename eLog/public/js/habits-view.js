document.addEventListener('DOMContentLoaded', deleteHabit, false);

function deleteHabit(e)
{
    let element = document.querySelector('.delete-habit-form');

    element.addEventListener('submit', function(event) {
        event.preventDefault();
        if(confirm('Do you really want to delete this habit?')) {
            event.target.submit();
        }
      });
}
