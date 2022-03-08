let firstname = document.getElementById('firstname')
let lastname = document.getElementById('lastname')
let codename = document.getElementById('codename')
let nationality = document.getElementById('nationality')
let submitBtn = document.getElementById('submit')
let error =''
let regx = /[^a-zA-ZÀ-ž\-\'\ ]/mg

function verifyFirstname(value){
    if(value =='' || value.length > 50 || regx.test(value)){
        error += 'Prénom invalide.\n'
    }
}

function verifyLastname(value){
    if(value =='' || value.length > 50 || regx.test(value)){
        error += 'Nom invalide.\n'
    }
}

function verifyCodename(value){
    if(value =='' || value.length > 50){
        error += 'Nom de code invalide.\n'
    }
}

function verifyNationality(value){
    if(isNaN(value) || value < 1){
        error += 'Nationalité invalide.\n'
    }
}

submitBtn.addEventListener('click', function(event){
    verifyFirstname(firstname.value)
    verifyLastname(lastname.value)
    verifyCodename(codename.value)
    verifyNationality(nationality.value)
    if(error !==''){
        alert(error)
        error = ''
        event.preventDefault()
    } 
})