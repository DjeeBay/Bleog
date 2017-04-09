var myForm = document.forms['memoriesForm'];

myForm.onsubmit = function(e) {
    e.preventDefault();
    console.log(myForm);

    var urlToPost = this.getAttribute('action');;

    var data = new FormData(myForm);

    var http = new XMLHttpRequest();
    http.open('POST', urlToPost, true);

    http.send(data);

    http.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            var response = this.responseText;
            console.log(JSON.parse(response));
            var res = JSON.parse(response);
            addLastInsertedMemory(res.data);

            var successDiv = document.getElementById('addedWithSuccess');
            successDiv.classList.remove('hidden');

            var successText = document.getElementById('addedText');
            successText.innerHTML = 'Évènement du <b>'+res.data.formatted_event_date+'</b> ajouté avec succès !';
        }
    };

    function addLastInsertedMemory(memory) {
        var memoriesList = document.getElementById('memories-list');

        var parentDiv = document.createElement('div');
        parentDiv.className = 'clearfix';

        var secondDiv = document.createElement('div');
        parentDiv.appendChild(secondDiv);

        var dateDiv = document.createElement('div');
        var dateB = document.createElement('b');
        dateB.textContent = memory.formatted_event_date;
        dateDiv.appendChild(dateB);

        var descriptionDiv = document.createElement('div');
        var descriptionSpan = document.createElement('span');
        descriptionSpan.textContent = memory.description;
        descriptionDiv.appendChild(descriptionSpan);

        secondDiv.appendChild(dateDiv);
        secondDiv.appendChild(descriptionDiv);


        // memoriesList.appendChild(parentDiv);
        if (memory.position !== -1) {
            memoriesList.insertBefore(parentDiv, memoriesList.children[memory.position]);
        }
    }
};