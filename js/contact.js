document.getElementById('contact-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Ngăn chặn hành động gửi biểu mẫu mặc định
    
    const formData = new FormData(this);
    const xhr = new XMLHttpRequest();
    
    // Sử dụng JSON Placeholder
    xhr.open('POST', 'https://jsonplaceholder.typicode.com/posts', true);
    xhr.onload = function () {
        if (xhr.status === 201) { // JSON Placeholder trả về status 201 khi thành công
            document.getElementById('form-message').textContent = 'Your message has been sent successfully!';
            document.getElementById('form-message').style.color = 'green';
        } else {
            document.getElementById('form-message').textContent = 'There was a problem sending your message. Please try again later.';
            document.getElementById('form-message').style.color = 'red';
        }
    };
    
    xhr.send(formData);
});
