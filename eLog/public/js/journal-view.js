document.addEventListener('DOMContentLoaded', journalForm, false);

function journalForm(e)
{
    let textArea = document.querySelector('.textarea-form');
    textArea.value = textArea.defaultValue.trim();

    textArea.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = this.scrollHeight + 'px';
      });
    
    let title = document.querySelector('.title-form');
    title.value = title.defaultValue.trim();
}
