"use strict";
document.addEventListener('DOMContentLoaded', function () {

    let renderLink = function(url) {
        document.getElementById('registration-link').innerText = 'Registration link';
        document.getElementById('registration-link').classList.remove('hidden');
        document.getElementById('registration-link').setAttribute('href', url);
    }

    document.getElementById('deactivate-link-form').addEventListener('submit',
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
                    disableButton(e.submitter, 'Link already inactive');
                })
                .catch(error => {
                    enableButton(e.submitter, 'Try link deactivation one more time');
                    renderErrors([error]);
                });
        });
});
