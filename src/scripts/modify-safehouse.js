let codename = document.getElementById('codename')
let type = document.getElementById('type')
let address = document.getElementById('address')
let postalCode = document.getElementById('postalCode')
let city = document.getElementById('city')
let submitBtn = document.getElementById('submit')
let error =''
let regx = /[^a-zA-ZÀ-ž\-\'\ ]/mg
let pcRegx = /[^0-9a-zA-ZÀ-ž\ ]/gm
let addressRgx = /[^0-9a-zA-ZÀ-ž\-\'\ ]/gm


function verifyCity(value){
    if(value =='' || value.length > 100 || regx.test(value)){
        error += 'Ville invalide.\n'
    }
}

function verifyAddress(value){
    if(value =='' || value.length > 100 || addressRgx.test(value)){
        error += 'Adresse invalide.\n'
    }
}

function verifyCodename(value){
    if(value =='' || value.length > 20){
        error += 'Nom de code invalide.\n'
    }
}

function verifyPostalCode(value){
    if(value =='' || value.length > 10 || pcRegx.test(value)){
        error += 'Code postal invalide.\n'
    }
}

function verifyType(value){
    if(isNaN(value) || value < 1){
        error += 'Type de planque invalide.\n'
    }
}


submitBtn.addEventListener('click', function(event){
    verifyCodename(codename.value)
    verifyType(type.value)
    verifyAddress(address.value)
    verifyPostalCode(postalCode.value)
    verifyCity(city.value)
    
    if(error !==''){
        alert(error)
        error = ''
        event.preventDefault()
    } 
})