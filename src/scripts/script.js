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

