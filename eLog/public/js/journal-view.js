document.addEventListener('DOMContentLoaded', loadTextArea, false);

function loadTextArea(e)
{
    let textArea = document.querySelector('.textarea-form');
    textArea.value = textArea.defaultValue.trim();

    textArea.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = this.scrollHeight + 'px';
      });
}
