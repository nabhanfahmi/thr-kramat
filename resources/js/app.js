import './bootstrap';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

document.addEventListener("DOMContentLoaded", () => {
    const editorElement = document.querySelector('#editor');
    if (editorElement) {
        ClassicEditor.create(editorElement, {
            toolbar: [
                'heading','|','bold','italic','link','blockQuote',
                'numberedList','bulletedList','insertTable','undo','redo'
            ]
        })
        .catch(error => {
            console.error(error);
        });
    }
});

