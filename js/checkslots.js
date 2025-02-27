const squares = document.querySelectorAll('.square');
const selectedSlotInput = document.getElementById('selected-slot');


squares.forEach(square => {
    square.addEventListener('click', () => {
        squares.forEach(otherSquare => {
            if(otherSquare.style.backgroundColor!='red'){
            otherSquare.style.backgroundColor = 'rgb(2, 192, 2)';
            otherSquare.style.color = 'white';
            }
        });

        if(square.style.backgroundColor!='red'){
        square.style.backgroundColor = 'yellow';
        square.style.color = 'black';
        selectedSlotInput.value = square.textContent;
        }
    });
});

document.addEventListener('click', (event) => {
    if (!event.target.classList.contains('square')&&!event.target.closest('.rightside') &&
    !event.target.closest('.forminputs')) {
        // Reset colors to initial values
        squares.forEach(square => {
            if(square.style.backgroundColor!='red'){
            square.style.backgroundColor = 'rgb(2, 192, 2)';
            square.style.color = 'white';
            selectedSlotInput.value ="";
            }
        });
    }
});


