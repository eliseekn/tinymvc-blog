document.addEventListener('DOMContentLoaded', () => {
    if (document.querySelector('#editor')) {
        const editor = new Quill('#editor', {
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                    ['bold', 'italic', 'underline'],
    
                    [{ 'align': [] }],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'script': 'sub'}, { 'script': 'super' }],
    
                    [{ 'size': ['small', false, 'large', 'huge'] }],
                    [{ 'color': [] }, { 'background': [] }],
    
                    ['clean']
                ]
            },
    
            theme: 'snow'
        })
    
        if (document.querySelector('#create-post')) {
            document.querySelector('#create-post').addEventListener('submit', event => {
                event.preventDefault()
                
                let formData = new FormData()
                formData.append('csrf_token', document.querySelector('#csrf_token').value)
                formData.append('title', document.querySelector('#create-post #title').value)
                formData.append('content', editor.root.innerHTML)
                formData.append('image', document.querySelector('#create-post #image').files[0])
        
                fetch(document.querySelector('#create-post').dataset.url, {
                    method: 'post',
                    body: formData
                }).then(() => window.location.reload())
            })
        }
    
        if (document.querySelector('#update-post')) {
            document.querySelector('#update-post').addEventListener('submit', event => {
                event.preventDefault()
                
                let formData = new FormData()
                formData.append('csrf_token', document.querySelector('#csrf_token').value)
                formData.append('title', document.querySelector('#update-post #title').value)
                formData.append('content', editor.root.innerHTML)
                formData.append('image', document.querySelector('#update-post #image').files[0])
        
                fetch(document.querySelector('#update-post').dataset.url, {
                    method: 'post',
                    body: formData
                }).then(() => window.location.reload())
            })
        }
    }
})
