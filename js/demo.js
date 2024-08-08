// Get all square elements
const squares = document.querySelectorAll('.square');
const selectedSlotInput = document.getElementById('selected-slot');

// Add event listener to each square
squares.forEach(square => {
    square.addEventListener('click', () => {
        // Reset background color of all squares
        squares.forEach(otherSquare => {
            if(otherSquare.style.backgroundColor!='red'){
            otherSquare.style.backgroundColor = 'rgb(2, 192, 2)';
            otherSquare.style.color = 'white';
            }
        });

        // Change color of the clicked square to red
        if(square.style.backgroundColor!='red'){
        square.style.backgroundColor = 'yellow';
        square.style.color = 'black';
        selectedSlotInput.value = square.textContent;
        }
    });
});

// Add event listener to the document
document.addEventListener('click', (event) => {
    const vtype=document.getElementById("vehicle-type");
    // Check if the clicked element is not a square or the select button
    if (!event.target.classList.contains('square')&&!event.target.closest('.rightside') &&
    !event.target.closest('.forminputs')) {
        // Reset colors to initial values
        squares.forEach(square => {
            if(square.style.backgroundColor!='red'){
            square.style.backgroundColor = 'rgb(2, 192, 2)';
            square.style.color = 'white';
            selectedSlotInput.value =" ";
            vtype.placeholder="Select Vehicle Type";
            }
        });
    }
});
