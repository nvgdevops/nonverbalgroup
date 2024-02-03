/*
Template Name: Shreyu - Responsive Bootstrap 5 Admin Dashboard
Author: CoderThemes
Website: https://coderthemes.com/
Contact: support@coderthemes.com
File: Form Edior init js
*/


// Snow theme

if(document.getElementById("structured_transcript") != null) {

    var quill = new Quill('#snow-editor', {
        theme: 'snow',
        modules: {
            'toolbar': [[{ 'font': [] }, { 'size': [] }], ['bold', 'italic', 'underline', 'strike'], [{ 'color': [] }, { 'background': [] }], [{ 'script': 'super' }, { 'script': 'sub' }], [{ 'header': [false, 1, 2, 3, 4, 5, 6] }, 'blockquote', 'code-block'], [{ 'list': 'ordered' }, { 'list': 'bullet' }, { 'indent': '-1' }, { 'indent': '+1' }], ['direction', { 'align': [] }], ['link', 'image', 'video', 'formula'], ['clean']]
        },
    });
    quill.on('text-change', function(delta, oldDelta, source) { 
        $('#structured_transcript').val(quill.container.firstChild.innerHTML);
    });

}
// Snow theme

if(document.getElementById("key_points") != null) {
    
    var quill1 = new Quill('#snow-editor-2', {
        theme: 'snow',
        modules: {
            'toolbar': [[{ 'font': [] }, { 'size': [] }], ['bold', 'italic', 'underline', 'strike'], [{ 'color': [] }, { 'background': [] }], [{ 'script': 'super' }, { 'script': 'sub' }], [{ 'header': [false, 1, 2, 3, 4, 5, 6] }, 'blockquote', 'code-block'], [{ 'list': 'ordered' }, { 'list': 'bullet' }, { 'indent': '-1' }, { 'indent': '+1' }], ['direction', { 'align': [] }], ['link', 'image', 'video', 'formula'], ['clean']]
        },
    });
     
    quill1.on('text-change', function(delta, oldDelta, source) { 
        $('#key_points').val(quill1.container.firstChild.innerHTML);
    });
    
}
        
/*---- Content Page Start ----*/
        
        
// Snow theme

if(document.getElementById("container_content") != null) {

    var quill2 = new Quill('#snow-editor-3', {
        theme: 'snow',
        modules: {
            'toolbar': [[{ 'font': [] }, { 'size': [] }], ['bold', 'italic', 'underline', 'strike'], [{ 'color': [] }, { 'background': [] }], [{ 'script': 'super' }, { 'script': 'sub' }], [{ 'header': [false, 1, 2, 3, 4, 5, 6] }, 'blockquote', 'code-block'], [{ 'list': 'ordered' }, { 'list': 'bullet' }, { 'indent': '-1' }, { 'indent': '+1' }], ['direction', { 'align': [] }], ['link', 'image', 'video', 'formula'], ['clean']]
        },
    });
     
    quill2.on('text-change', function(delta, oldDelta, source) { 
        $('#container_content').val(quill2.container.firstChild.innerHTML);
    });

}
    
// Snow theme

if(document.getElementById("video_content") != null) {
    
    var quill3 = new Quill('#snow-editor-4', {
        theme: 'snow',
        modules: {
            'toolbar': [[{ 'font': [] }, { 'size': [] }], ['bold', 'italic', 'underline', 'strike'], [{ 'color': [] }, { 'background': [] }], [{ 'script': 'super' }, { 'script': 'sub' }], [{ 'header': [false, 1, 2, 3, 4, 5, 6] }, 'blockquote', 'code-block'], [{ 'list': 'ordered' }, { 'list': 'bullet' }, { 'indent': '-1' }, { 'indent': '+1' }], ['direction', { 'align': [] }], ['link', 'image', 'video', 'formula'], ['clean']]
        },
    });
     
    quill3.on('text-change', function(delta, oldDelta, source) { 
        $('#video_content').val(quill3.container.firstChild.innerHTML);
    });
        
}
        
// Snow theme

if(document.getElementById("practice_content") != null) {
    
    var quill4 = new Quill('#snow-editor-5', {
        theme: 'snow',
        modules: {
            'toolbar': [[{ 'font': [] }, { 'size': [] }], ['bold', 'italic', 'underline', 'strike'], [{ 'color': [] }, { 'background': [] }], [{ 'script': 'super' }, { 'script': 'sub' }], [{ 'header': [false, 1, 2, 3, 4, 5, 6] }, 'blockquote', 'code-block'], [{ 'list': 'ordered' }, { 'list': 'bullet' }, { 'indent': '-1' }, { 'indent': '+1' }], ['direction', { 'align': [] }], ['link', 'image', 'video', 'formula'], ['clean']]
        },
    });
     
    quill4.on('text-change', function(delta, oldDelta, source) { 
        $('#practice_content').val(quill4.container.firstChild.innerHTML);
    });
    
}

// Snow theme

if(document.getElementById("pdf_description") != null) {
        
    var quill5 = new Quill('#snow-editor-6', {
        theme: 'snow',
        modules: {
            'toolbar': [[{ 'font': [] }, { 'size': [] }], ['bold', 'italic', 'underline', 'strike'], [{ 'color': [] }, { 'background': [] }], [{ 'script': 'super' }, { 'script': 'sub' }], [{ 'header': [false, 1, 2, 3, 4, 5, 6] }, 'blockquote', 'code-block'], [{ 'list': 'ordered' }, { 'list': 'bullet' }, { 'indent': '-1' }, { 'indent': '+1' }], ['direction', { 'align': [] }], ['link', 'image', 'video', 'formula'], ['clean']]
        },
    });
     
    quill5.on('text-change', function(delta, oldDelta, source) { 
        $('#pdf_description').val(quill5.container.firstChild.innerHTML);
    });
    
}

/*---- Content Page End ----*/
        
        