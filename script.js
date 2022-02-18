let missionStatus = document.getElementsByClassName("status")

for(i=0 ; i< missionStatus.length; i++){
    switch(missionStatus[i].textContent){
        case 'En cours':
            missionStatus[i].classList = 'card-text text-primary status'
            break
        case 'En préparation' :
            missionStatus[i].classList = 'card-text text-secondary status'
            break
        case 'Terminé' :
            missionStatus[i].classList = 'card-text text-success status'
            break
        case 'Échec':
            missionStatus[i].classList = 'card-text text-danger status'
            break
        default :
            missionStatus[i].classList = 'card-text text-secondary status'
    }
}

let missionDetailStatus = document.getElementById('status')
console.log(missionDetailStatus.textContent)

switch(missionDetailStatus.textContent){
    case 'En cours':
        missionDetailStatus.classList = 'col-8 col-md-4 rounded-pill blue39 text-center p-1 text-white fw-bold'
        break
    case 'En préparation' :
        missionDetailStatus.classList = 'col-8 col-md-4 rounded-pill white39 text-center p-1 text-white fw-bold'
        break
    case 'Terminé' :
        missionDetailStatus.classList = 'col-8 col-md-4 rounded-pill green39 text-center p-1 text-white fw-bold'
        break
    case 'Échec':
        missionDetailStatus.classList = 'col-8 col-md-4 rounded-pill red39 text-center p-1 text-white fw-bold'
        break
    default :
        missionDetailStatus.classList = 'col-8 col-md-4 rounded-pill white39 text-center p-1 text-white fw-bold'
}