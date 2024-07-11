
        document.addEventListener('DOMContentLoaded', function() {
            var contactForm = document.getElementById('contact-form');
            var formStatus = document.getElementById('form-status');

            contactForm.addEventListener('submit', function(e) {
                e.preventDefault();

                // Show a loading message or spinner
                formStatus.textContent = 'Sending message...';

                // Extract form data
                var formData = new FormData(contactForm);

                // Example for handling form submission with Fetch API
                fetch('/contact', {
                    method: 'POST',
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        formStatus.textContent = 'Message sent successfully!';
                        contactForm.reset();
                    } else {
                        formStatus.textContent = 'An error occurred. Please try again.';
                    }
                })
                .catch(error => {
                    formStatus.textContent = 'An error occurred. Please try again.';
                });
            });
        });
    