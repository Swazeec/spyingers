let submitBtn = document.getElementById('submit')
let missionType = document.getElementById('missionType')
let title = document.getElementById('title')
let missionStatus = document.getElementById('status')
let codename = document.getElementById('codename')
let description = document.getElementById('description')
let startDate = document.getElementById('missionStart')
let endDate = document.getElementById('missionEnd')
let safehouses = document.querySelectorAll('#safehouses :checked')
let otherAgents = document.querySelectorAll('#otherAgents :checked')

let error=''
function verifyTitle(value){
    if(value === ''){
        error += 'Titre invalide.\n'
    } else if (value.length > 100){
        error += 'Titre trop long : 100 caractères max !\n'
    }
}

function verifyMissionType(value){
    if(isNaN(value) || value < 1 || value > 8){
        error += 'Type de mission invalide.\n'
    }
}

function verifyStatus(value){
    if(isNaN(value) || value < 1 || value > 4){
        error += 'Statut invalide.\n'
    }
}

function verifyCodename(value){
    if(value === ''){
        error += 'Nom de code invalide.\n'
    } else if (value.length > 50){
        error += 'Nom de code trop long : 50 caractères max !\n'
    }
}

function verifyDescription(value){
    if(value === ''){
        error += 'Description invalide.\n'
    }
}

function verifyDates(value1, value2){
    let start = new Date(value1).getTime()
    let end = new Date(value2).getTime()
    if(isNaN(start) || isNaN(end)){
        error += 'Format de dates invalide.\n'
    } else if(end < start){
        error += 'Dates invalides.\n'
    }
}

function verifySafehouses(values){
    let shError = 0
    values.forEach(function(value){
        if(isNaN(value.value)){
            shError = 1
        } 
    })
    if(shError != 0){
        error += 'Planque(s) invalide(s).\n'
    }
}

function verifyOtherAgents(values){
    oaError = 0
    values.forEach(function(value){
        if(isNaN(value.value)){
            oaError = 1
        } 
    })
    if(oaError != 0){
        error += 'Agent(s) invalide(s).\n'
    }
}

submitBtn.addEventListener('click', function(event){
    verifyTitle(title.value)
    verifyMissionType(missionType.value)
    verifyStatus(missionStatus.value)
    verifyCodename(codename.value)
    verifyDescription(description.value)
    verifyDates(startDate.value, endDate.value)
    verifySafehouses(safehouses)
    verifyOtherAgents(otherAgents)

    if(error !==''){
        alert(error)
        error=''
        event.preventDefault()
    } 

})