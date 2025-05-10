"use strict";
document.addEventListener('DOMContentLoaded', function () {

    let renderLink = function(url) {
        document.getElementById('registration-link').innerText = 'Registration link';
        document.getElementById('registration-link').classList.remove('hidden');
        document.getElementById('registration-link').setAttribute('href', url);
    }

    document.getElementById('registration-form').addEventListener('submit',
        function (e) {
            e.preventDefault();
            disableButton(e.submitter, 'Loading ...');

            fetch(
                this.action,
                {
                    method: 'POST',
                    headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'Accept': 'application/json',
                },
                body: new FormData(this),
            })
            .then(response => response.json())
            .then(data => {
                const isLinkPresentInResponse = (data.data && data.data.url);

                if (isLinkPresentInResponse) {
                    renderLink(data.data.url);

                    document.getElementById('registration-form').classList.add('hidden');
                } else {
                    if (data.error) {
                        renderGlobalErrors(data.error);
                    }

                    if (data.errors) {
                        renderFormErrors(data.errors);
                    }
                }

                enableButton(e.submitter, 'Register');
            })
            .catch(error => {
                enableButton(e.submitter, 'Register');

                if (error) {
                    renderGlobalErrors([error]);
                }
            });
    });
});
