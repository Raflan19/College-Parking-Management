document.addEventListener("DOMContentLoaded",updateSlots);
function updateSlots(e){
    e.preventDefault();
    var xhr=new XMLHttpRequest();
    xhr.open('GET','../htmlphp/slot.php',true);
    xhr.onload=function(){
        // console.log(this.status);
        if(this.status==200){
            // console.log(this.responseText);
            var slot1=JSON.parse(this.responseText);
        }
        for(var i in slot1){
            let now = new Date();
            let hours = now.getHours().toString().padStart(2, '0');
            let minutes = now.getMinutes().toString().padStart(2, '0');
            let seconds = now.getSeconds().toString().padStart(2, '0');
            let currentTime = `${hours}:${minutes}:${seconds}`;
            // console.log(currentTime);
            if(slot1[i].status=="booked"&&slot1[i].endtime>=currentTime){
                document.getElementById(`${slot1[i].slotno}`).style.backgroundColor='red';
                document.getElementById(`${slot1[i].slotno}`).style.color='white';
            }
            else{
                document.getElementById(`${slot1[i].slotno}`).style.backgroundColor='rgb(2, 192, 2)';
                document.getElementById(`${slot1[i].slotno}`).style.color='white';

            }
    }
}
    xhr.send();
}
