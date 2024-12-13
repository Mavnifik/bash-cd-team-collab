// Function to toggle visibility of sections
function showSection(sectionId) {
    // Get all sections in the document
    var sections = document.querySelectorAll('.section');
    
    // Hide all sections
    sections.forEach(function(section) {
        section.style.display = 'none';
    });

    // Get the selected section by its ID
    var selectedSection = document.getElementById(sectionId);
    
    // If the selected section exists, show it
    if (selectedSection) {
        selectedSection.style.display = 'block';
    } else {
        console.error('Section not found: ' + sectionId);
    }
}
