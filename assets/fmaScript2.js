let templateframe = document.getElementById('template-frame');
let firstnameField = document.getElementById('firstname');
let lastnameField = document.getElementById('lastname');
let experienceStocks = [];
let educationStocks = [];
let skillStock = [];
let viewCandidate = {};
let candidate = function (firstname,lastname,emailAddress,phoneNumber,fonction,resume){
    this.firstname=firstname;
    this.lastname=lastname;
    this.emailAddress=emailAddress;
    this.phoneNumber = phoneNumber;
    this.fonction =fonction;
    this.resume =resume;

    this.getFirstname = function (){
        return this.firstname;
    }
    this.getLastname = function (){
        return this.lastname;
    }
    this.getEmailAddress = function (){
        return this.emailAddress;
    }
    this.getPhoneNumber = function (){
        return this.phoneNumber;
    }
    this.getfonction = function (){
        return this.fonction;
    }
    this.getResume = function (){
        return this.resume;
    }
    this.setFirstname=  function (firstname){
        this.firstname = firstname;
    }
    this.setLastname = function (lastname){
        this.lastname = lastname;
    }
    this.setFonction = function (fonction){
        this.fonction = fonction;
    }
    this.setResume = function (resume){
        this.resume = resume;
    }
    this.setPhoneNumber = function (phoneNumber){
        this.phoneNumber = phoneNumber;
    }
}
let ViewModelCandidate = function (){
    this.CandidateModel = null;
    this.experiences = [];
    this.skills = [];
    this.educations = [];

    this.reset = function (ViewModelCandidate){
        ViewModelCandidate.CandidateModel = null;
        ViewModelCandidate.educations = [];
        ViewModelCandidate.skills= [];
        ViewModelCandidate.experiences = [];
    }

    this.setCandidate = function (candidate){
        this.CandidateModel = candidate;
    }
    this.setExperiences = function (experiences){
        this.experiences = experiences;
    }
    this.setEducations = function (educations){
        this.educations = educations;
    }
    this.setSkills = function (skills){
        this.skills = skills;
    }
}
let skillObject = function (title,description,level,yearExperience){
    this.title = title;
    this.description = description;
    this.level = level;
    this.yearExperience = yearExperience;

    this.setID = function (ID){
        this.ID = ID;
    }

    this.isValid = function (){
        if(this.title !== '' && this.description !== '' && this.level !== '' && this.yearExperience !== ''){
            return true;
        }else{
            return false;
        }
    }
}
let experienceObject = function (poste,postDescritp,companie,location,startDate,endDate){
    this.poste = poste;
    this.postDescritp = postDescritp;
    this.startDate = startDate;
    this.endDate = endDate;
    this.location = location;
    this.companie = companie;
    this.Stockages = [];
    this.reset = function (){
        this.Stockages = [];
    }
    this.setID = function (ID){
        this.ID = ID;
    }
    this.get = function (){
        return this;
    }
    this.isValid = function (){
        if(String(this.poste) !== '' &&  String(this.postDescritp) !=='' && this.startDate != null && this.endDate != null && this.companie !='' && this.location !== ''){
            return true;
        }else{
            return false;
        }
    }
    this.array = function (){
        return [this.poste,this.postDescritp,this.companie,this.location ,this.startDate,this.endDate];
    }
    this.getStockages = function (){
        return this.Stockages;
    }
    this.addExperience = function (experience){
        this.Stockages.push(experience);
    }
    this.deleteExperience = function (experineceID){

    }
}
function resetExperienceForm(){
    $('#poste').val('');
    $('#descriptionExperience').val('');
    $('#companyName').val('');
    $('#whereYouWork').val('');
    $('#StartDate').val('');
    $('#EndDate').val('');
}
function resetSkillForm(){
    $('#skillTitle').val('');
    $('#skillDes').val('');
    $('#level').val('');
    $('#yearExperience').val('');
}
function  SubmitSkillForm(element){
    let skill = new skillObject($('#skillTitle').val(),$('#skillDes').val(),$('#level').val(),$('#yearExperience').val());
    if(skill.isValid()){
        let ID = skillStock.length + 1;
        skill.setID(ID);
        skillStock.push(skill);
        let body = $('#skillbody');
        body.children('tr').remove();
        for(let i= 0; i<= skillStock.length - 1 ; i++){
            let node = document.createElement('tr');
            let skill = skillStock[i];
            node.setAttribute('id',skill.ID);
            insertRowCell(skill.title,node);
            insertRowCell(skill.description,node);
            insertRowCell(skill.level,node);
            insertRowCell(skill.yearExperience,node);
            insertRowCell(skill.ID,node,1);
            body.append(node);
        }
        resetSkillForm();
    }
    synchro();
}
function  SubmitExperienceForm(elemnt){
    let experiences = new experienceObject($('#poste').val(),$('#descriptionExperience').val(),$('#companyName').val(),$('#whereYouWork').val(),$('#StartDate').val(),$('#EndDate').val());
    if(experiences.isValid()){
        let ID = experienceStocks.length + 1;
        experiences.setID(ID);
        experienceStocks.push(experiences);
        let body = $('#bodyID');
        body.children('tr').remove();
        for(let i= 0; i<= experienceStocks.length - 1 ; i++){
            let node = document.createElement('tr');
            let experience = experienceStocks[i];
            node.setAttribute('id',experience.ID);
            insertRowCell(experience.poste,node);
            insertRowCell(experience.postDescritp,node);
            insertRowCell(experience.companie,node);
            insertRowCell(experience.location,node);
            insertRowCell(experience.startDate,node);
            insertRowCell(experience.endDate,node);
            insertRowCell(experience.ID,node,1);
            body.append(node);
        }
        resetExperienceForm();
    }
    synchro();

}
function  ValidateCandidateInfoForm(){
    if($('#firstname').val() !=='' && $('#lastname').val()!=='' && $('#emailAddress').val()!=='' && $('#phoneNumber').val()!=='' && $('#location').val()!==''
        && $('#fonction').val()!=='' && $('#resume').val()!==''){
        return true;
    }
    else{return false;}
}
function  ValidateExperiencesList(){
    if(experienceStocks.length === 0){
        return false;
    }else{return true;}
}
function  ValidateSkillList(){
    if(skillStock.length === 0){
        return false;
    }else{return true;}
}
function ValidateEducations(){
    if(educationStocks.length === 0){
        return false;
    }else{return true;}
}
function  ExecuteFuncValidationStep(step){
    let authorizeContinu = false;
    switch (parseInt(step)){
        case 1:
            if(ValidateCandidateInfoForm()){
                authorizeContinu = true;
            }
            break;
        case 2:
            if(ValidateExperiencesList()){
                authorizeContinu = true;
            }
            break;
        case 3:
            if(ValidateSkillList()){
                authorizeContinu = true;
            }
            break;
        case 4:
            if(ValidateEducations()){
                authorizeContinu = true;
            }
            break;
        default:
            break;
    }
    return authorizeContinu;
}
function synchro(){
    let candStorage = window.sessionStorage.getItem('viewCand');
    console.log(candStorage);
    let viewobject = null;
    if(candStorage !== null){
        viewobject = JSON.parse(candStorage);
        viewobject.experiences = experienceStocks;
        viewobject.skills = skillStock;
        viewobject.educations = educationStocks;
        window.sessionStorage.setItem('viewCand',JSON.stringify(viewobject));
    }
    console.log(viewobject);
}
function RemoveExperience(element,value){
    let body = $('#bodyID');
    let elementID = parseInt(value);
    body.children('tr[id='+elementID+']').remove();
    let findIndex = experienceStocks.findIndex((e)=>e.ID===elementID);
    if(findIndex !== -1){
        experienceStocks.splice(findIndex,1);
    }
    synchro();
}
function  insertRowCell(value,rowNew,isDelete = 0){
    let node = document.createElement('td');
    if(isDelete === 1){
        let btn = document.createElement('button');
        btn.setAttribute('type','button');
        btn.textContent = 'Supprimer';
        btn.setAttribute('onClick','RemoveExperience(this,"' + value + '")');
        node.appendChild(btn);
    }else{
        node.textContent = value;
    }
    rowNew.appendChild(node);
}
function  replaceAllValues(searchValue = [],replaceValue = [], value){
    let returnValues = String(value);
    console.log(replaceValue);
    console.log(searchValue);
    if(searchValue.length !== replaceValue.length){
        return null;
    }
    searchValue.forEach((value,index,arr)=>{
        returnValues = returnValues.replace(value,replaceValue[index]);;
    })
    return returnValues;
}
function ChangeTemplateColor(colorItem){
    let colorDefault = templateframe.contentWindow.document.getElementById('defaultColor').value;
    let color = colorItem.getAttribute('color');
    let collectionColorChange = templateframe.contentWindow.document.getElementsByClassName('bg-color-change');
    let collectionBorderChange = templateframe.contentWindow.document.getElementsByClassName('border-change-color');
    let collectionTextChange = templateframe.contentWindow.document.getElementsByClassName('text-color');
    for(let i = 0; i <= collectionColorChange.length - 1 ; i++){
        collectionColorChange[i].style.backgroundColor = color;
    }
    for(let i = 0; i <= collectionBorderChange.length - 1 ;i++){
        collectionBorderChange[i].style.borderColor = color;
    }
    for(let i = 0; i <= collectionTextChange.length - 1 ;i++){
        collectionTextChange[i].style.color = color;
    }
}
function  ExecutionCandidateForm(element,action){
    let currentStep = document.getElementById('currentStepForm').getAttribute('current-step');
    if(!ExecuteFuncValidationStep(currentStep) && action ==='next'){
        return false;
    }else{
        switch (action){
            case 'next':
                if(currentStep < 4){
                    let nextStep = parseInt(currentStep) + 1;
                    let prevElementId = 'form-step-' + String(currentStep);
                    let nextElementId = 'form-step-' + String(nextStep);
                    $('#' + prevElementId).fadeOut();
                    $('#' + nextElementId).fadeIn();
                    if(nextStep > 1){
                        $('#prevBtn').show();
                    }
                    document.getElementById('currentStepForm').setAttribute('current-step',String(nextStep));
                }
                else if(currentStep >= 4){
                    $('#prevBtn').show();
                    $('#nextBtn').innerText='Lancer génération';
                }
                break;
            case 'prev':
                if(currentStep > 1){
                    let nextStep = parseInt(currentStep) - 1;
                    let prevElementId = 'form-step-' + nextStep;
                    let buildNextElementId = 'form-step-' + currentStep;
                    $('#' + buildNextElementId).fadeOut();
                    $('#' + prevElementId).fadeIn();
                    document.getElementById('currentStepForm').setAttribute('current-step',String(nextStep));
                    if(nextStep <= 1){
                        $('#prevBtn').hide();
                    }
                }
                if(currentStep <= 1){
                    $('#prevBtn').show();
                }
                break;
            default:
                break;
        }
    }

}
function MouseLeave(colorItem){
    let colorDefault = templateframe.contentWindow.document.getElementById('defaultColor').value;
    let collectionColorChange = templateframe.contentWindow.document.getElementsByClassName('bg-color-change');
    let collectionBorderChange = templateframe.contentWindow.document.getElementsByClassName('border-change-color');
    let collectionTextChange = templateframe.contentWindow.document.getElementsByClassName('text-color');
    for(let i = 0; i <= collectionColorChange.length - 1 ; i++){
        collectionColorChange[i].style.backgroundColor = colorDefault;
    }
    for(let i = 0; i <= collectionBorderChange.length - 1 ;i++){
        collectionBorderChange[i].style.borderColor = colorDefault;
    }
    for(let i = 0; i <= collectionTextChange.length - 1 ;i++){
        collectionTextChange[i].style.color = colorDefault;
    }
}
window.addEventListener('DOMContentLoaded',function (){
    viewCandidate = new ViewModelCandidate();
    let candidateNew = new candidate('','','','','','');
    let candStorage = window.sessionStorage.getItem('viewCand');
    if(candStorage === null){
        viewCandidate.setCandidate(candidateNew);
        window.sessionStorage.setItem('viewCand',JSON.stringify(viewCandidate));
    }
    else{
        let Viewobject = JSON.parse(candStorage);
        Viewobject.CandidateModel = candidateNew;
        window.sessionStorage.setItem('viewCand',JSON.stringify(viewCandidate));
    }
    console.log(JSON.stringify(viewCandidate));
    GenerateCV(JSON.stringify(viewCandidate));
    $('.no-display').fadeOut();
    let nextButton = document.getElementById('nextBtn');
    let prevButton = document.getElementById('prevBtn');
    let form = document.getElementById('#candidateForm');
    let currentStep = document.getElementById('currentStepForm').getAttribute('current-step');
    if(parseInt(currentStep)===1){
        prevButton.style.display='none';
    }
    firstnameField.addEventListener('keyup',function (){
        let field = this;
        let value = String(field.value);
        let lastNameValue = String(lastnameField.value);
        let fullname = value + ' ' + lastNameValue;
        let defaultChange = templateframe.contentWindow.document.getElementById('userName').getAttribute('default-value');
        if((value !== '' || lastNameValue !== '')){
            templateframe.contentWindow.document.getElementById('userName').innerHTML=fullname;
        }
        else{
            templateframe.contentWindow.document.getElementById('userName').innerHTML=defaultChange;
        }
    });
    lastnameField.addEventListener('keyup',function (){
        let field = this;
        let value = String(field.value);
        let firstNameValue = String(firstnameField.value);
        let fullname = firstNameValue + ' ' + value;
        let defaultChange = templateframe.contentWindow.document.getElementById('userName').getAttribute('default-value');
        if((value !== '' || firstNameValue !== '')){
            templateframe.contentWindow.document.getElementById('userName').innerHTML=fullname;
        }
        else{
            templateframe.contentWindow.document.getElementById('userName').innerHTML=defaultChange;
        }
    });
});

let Request = function (method, url , rType , payload = null, body = null , headers = [],parameters = []){
    this.method = method;
    this.body = body;
    this.url = url;
    this.responseType = rType;
    this.parameters = parameters;
    this.payload = payload;
    this.xmlhttp = window.XMLHttpRequest ? (new XMLHttpRequest()) : (new ActiveXObject('Microsoft.XMLHTTP'));
};

Request.prototype.initFetchObject = function (callback){
    let self = this;
    if(self.xmlhttp != null){
        self.xmlhttp.responseType = self.responseType;
        self.xmlhttp.open(self.method,self.url);
    }else{throw  new Error("L'object de la requete ne pas pas etre est null.")}
    self.xmlhttp.onreadystatechange = function (event){
        callback(event,self.payload);
    }
}
Request.prototype.sendRequest = function (){
    let self = this;
    switch (self.method) {
        case 'GET':
            self.xmlhttp.send(null);
            break;
        case 'POST':
            self.xmlhttp.send(self.body);
            break;
        default:
            throw new Error('Méthode inconnu.');
    }
}

function CVGenerateResponse(event,payload){
    console.log(event);
}
function GenerateCV(candData){
    let url ='/generateTempl';
    let rq = new Request('POST',url,'application/json',null,{'candData':4});
    rq.initFetchObject(CVGenerateResponse)
    rq.sendRequest();
}