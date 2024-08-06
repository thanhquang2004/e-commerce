
        document.getElementById('contact-form').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission
            
            const formData = new FormData(this);
            const xhr = new XMLHttpRequest();
            
            xhr.open('POST', 'https://your-backend-endpoint.com/submit', true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    document.getElementById('form-message').textContent = 'Your message has been sent successfully!';
                } else {
                    document.getElementById('form-message').textContent = 'There was a problem sending your message. Please try again later.';
                }
            };
            
            xhr.send(formData);
        });