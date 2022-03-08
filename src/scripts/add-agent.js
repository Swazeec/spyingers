let firstname = document.getElementById('firstname')
let lastname = document.getElementById('lastname')
let birthDate = document.getElementById('birthDate')
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

function verifyBirthdate(value){
    let birth = new Date(value).getTime()
    let now = new Date().getTime()
    if(isNaN(birth)){
        error += 'Format de date invalide.\n'
    } else if(now < birth){
        error += 'Date invalide.\n'
    }
}

function verifyNationality(value){
    if(isNaN(value) || value < 1){
        error += 'Nationalité invalide.\n'
    }
}

function verifySpecialities(values){
    let speError = 0
    if(values.length === 0){
        speError = 1
    } else {
        values.forEach(function(value){
            if(isNaN(value.value)){
                speError = 1
            } 
        })
    }
    if(speError != 0){
        error += 'Spécialité(s) invalide(s).\n'
    }
}

submitBtn.addEventListener('click', function(event){
    let specialities = document.querySelectorAll('#specialities :checked')
    verifyFirstname(firstname.value)
    verifyLastname(lastname.value)
    verifyBirthdate(birthDate.value)
    verifyNationality(nationality.value)
    verifySpecialities(specialities)
    if(error !==''){
        alert(error)
        error = ''
        event.preventDefault()
    } 
})