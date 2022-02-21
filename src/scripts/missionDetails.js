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