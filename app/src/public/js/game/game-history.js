"use strict";
document.addEventListener('DOMContentLoaded', function () {

    const displayHistory = function(data) {
        let historyHTML = '';

        data.forEach((element, i) => {
            historyHTML += '<span>' + (i+1) + '. Status: ' + element.status
                + ' , Win points: ' + element.win_points + '</span><br/>'
        })

        const gameHistoryContainer =  document.getElementById('game-history-container');
        gameHistoryContainer.innerHTML = historyHTML;
        gameHistoryContainer.classList.remove('hidden');
    }

    document.getElementById('game-history').addEventListener('submit',
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
                    if (data.data && Array.isArray(data.data)) {
                        displayHistory(data.data.reverse());
                    }

                    enableButton(e.submitter, 'History');
                })
                .catch(error => {
                    enableButton(e.submitter, 'History');
                    renderErrors([error]);
                });
        });
});
