"use strict";
document.addEventListener('DOMContentLoaded', function () {

    const displayResults = function(data) {
        const realScoreContainer =  document.getElementById('game-real-score');
        realScoreContainer.classList.remove('hidden');
        realScoreContainer.querySelector('span').innerText = data.realScore;

        const gameStatusContainer = document.getElementById('game-status');
        gameStatusContainer.classList.remove('hidden');
        gameStatusContainer.querySelector('span').innerText = data.status;

        const winPointsContainer = document.getElementById('game-win-points');
        winPointsContainer.classList.remove('hidden');
        winPointsContainer.querySelector('span').innerText = data.winPoints;
    }

    document.getElementById('i-am-feeling-lucky-form').addEventListener('submit',
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
                    displayResults(data.data);

                    enableButton(e.submitter, 'Imfeelinglucky ... one more turn');
                })
                .catch(error => {
                    enableButton(e.submitter, 'Imfeelinglucky ... one more turn');
                    renderErrors([error]);
                });
        });
});
