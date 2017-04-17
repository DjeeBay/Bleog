var myForm = document.forms['memoriesForm'];

myForm.onsubmit = function(e) {
    e.preventDefault();

    var urlToPost = this.getAttribute('action');

    var data = new FormData(myForm);

    var http = new XMLHttpRequest();
    http.open('POST', urlToPost, true);

    http.send(data);

    http.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            var response = this.responseText;
            var res = JSON.parse(response);
            if (res.data.position !== -1) {
                addLastInsertedMemory(res.data);
            }

            var successDiv = document.getElementById('addedWithSuccess');
            successDiv.className = '';
            successDiv.className += ' alert alert-dismissible alert-success';

            var successText = document.getElementById('addedText');
            successText.innerHTML = 'Évènement du <b>'+res.data.formatted_event_date+'</b> ajouté avec succès !';
        }
    };
};

function deleteMemory(memory) {

    var divsList = document.querySelectorAll('#memories-list > div');

    var token = document.getElementById('_token').value;

    memory._token = token;

    var http = new XMLHttpRequest();
    http.open('POST', 'memories/delete', true);

    http.setRequestHeader('X-XSRF-TOKEN', token);
    http.setRequestHeader("Content-Type", "application/json");

    http.send(JSON.stringify(memory));

    http.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            var response = this.responseText;
            var res = JSON.parse(response);

            divsList[res.data.position].remove();

            if (res.data.memoryToDisplay) {
                addLastInsertedMemory(res.data.memoryToDisplay);
            }

            var successDiv = document.getElementById('addedWithSuccess');
            successDiv.className = '';
            successDiv.className += 'alert alert-dismissible alert-warning';

            var successText = document.getElementById('addedText');
            successText.innerHTML = 'L\'évènement du <b>'+res.data.formatted_event_date+'</b> a bien été supprimé !';
        }
    };
}

function addLastInsertedMemory(memory) {
    if (memory.position !== -1) {
        var memoriesList = document.getElementById('memories-list');

        var parentDiv = document.createElement('div');
        parentDiv.className = 'clearfix handHover p-relative memory-item';

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

        var spanDeleteParent = document.createElement('span');
        spanDeleteParent.className = 'memory-cancel';

        var spanDeleteChild = document.createElement('span');
        spanDeleteChild.className = 'glyphicon glyphicon-fire';
        spanDeleteChild.onclick = function () {
            deleteMemory(memory);
        };

        spanDeleteParent.appendChild(spanDeleteChild);

        parentDiv.appendChild(spanDeleteParent);

        memoriesList.insertBefore(parentDiv, memoriesList.children[memory.position]);

        var divsList = document.querySelectorAll('#memories-list > div');
        console.log(divsList.length);
        if (divsList.length > 20) {
            divsList[20].remove();
        }

        paginationManager(memory.totalMemories);
        console.log(memory);
    }
}

function paginationManager(totalMemories) {
    var paginationDiv = document.getElementById('pagination');

    console.log(paginationDiv);
    console.log(totalMemories);

    // if (totalMemories > 5)
}