
window.addEventListener('load',initForm);
function initForm(){
  fetchFromJson('services/getTerritoires.php')
  .then(processAnswer)
  .then(makeOptions);
  
  document.forms.form_communes.addEventListener("submit", sendForm);

  /**let ul = document.getElementById("liste_communes");

  ul.addEventListener("mouseover",function( event ){
    centerMapElt(event.target);
  });*/

  // décommenter pour le recentrage de la carte :
  document.forms.form_communes.territoire.addEventListener("change",function(event){
    centerMapElt(this[this.selectedIndex]);
  });
}

function processAnswer(answer){
  if (answer.status == "ok")
    return answer.result;
  else
    throw new Error(answer.message);
}


function makeOptions(tab){
  for (let territoire of tab){  
    let option = document.createElement('option');
    option.textContent = territoire.nom;
    option.value = territoire.id;
    document.forms.form_communes.territoire.appendChild(option);
    for (let k of ['min_lat','min_lon','max_lat','max_lon']){
      option.dataset[k] = territoire[k];
    }
  }
}


function sendForm(ev){ 
  ev.preventDefault();
  let args = new FormData(this);
  let param = new URLSearchParams(args).toString();
  let url = 'services/getCommunes.php?' + param;
  fetchFromJson(url)
    .then(processAnswer)
    .then(makeCommunesItems);
}


function makeCommunesItems(tab){
  let ul = document.getElementById("liste_communes");
  ul.textContent= "";

  for (let commune of tab){
    let li = document.createElement('li');
    li.textContent = commune.nom;
    li.value = commune.id;

    li.addEventListener("click",function(event){
      fetchCommune(event.target);
    });

    li.addEventListener("mouseover",function( event ){
      centerMapElt(event.target);
    });

    ul.appendChild(li);

    for (let k of ['insee','lat', 'lon', 'min_lat','min_lon','max_lat','max_lon']){
      li.dataset[k] = commune[k];
  }
}
}

function fetchCommune(li){
  let url = 'services/getDetails.php?insee='+li.dataset.insee;
  fetchFromJson(url)
    .then(processAnswer)
    .then(displayCommune);
}

function displayCommune(commune){
  let div = document.getElementById("details");
  div.textContent= "";
  for (let detail of ['insee','nom','nom_terr','lat','lon','surface','perimetre','pop2016']){
    let li = document.createElement('li');
    li.textContent = commune[detail];
    div.appendChild(li);
  }
  div.appendChild(createDetailMap(commune));
}

/**
 * Recentre la carte principale autour d'une zone rectangulaire
 * elt doit comporter les attributs dataset.min_lat, dataset.min_lon, dataset.max_lat, dataset.max_lon, 
 */
function centerMapElt(elt){
  let ds = elt.dataset;
  map.fitBounds([[ds.min_lat,ds.min_lon],[ds.max_lat,ds.max_lon]]);
}
