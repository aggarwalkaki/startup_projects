<?php
include "db.php";
session_start();
$userprofile = $_SESSION['username'];
   if($userprofile==true){

   }
   else{
    header("location:division.html");
   }

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STPI Data</title>
    <link rel="stylesheet" href="newstyles.css">
    <style>
        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .delete-mode {
            background-color: #ffdddd;
        }
    </style>
</head>
<body>
    <div id="header-container"></div>
    <div id="nav-container"></div>
    <button id="add-project-btn">Add Project</button>
    <button id="delete-project-btn">Delete Project</button>
  
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Address</th>
                <th>Budget</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="project-data">
            <!-- Data will be inserted here -->
        </tbody>
    </table>

    <!-- Add New Project Modal -->
    <div id="add-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form id="add-form">
                <h3>Add New Project</h3>
                <input type="hidden" id="ProjectID" name="ProjectID" value="1">
                <label for="Name_of_Project">Name:</label>
                <input type="text" id="Name_of_Project" name="Name_of_Project">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address">
                <label for="budget">Budget:</label>
                <input type="text" id="budget" name="budget">
                <button type="submit">Add Project</button>
            </form>
        </div>
    </div>

    <!-- Edit Project Modal -->
    <div id="edit-modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form id="edit-form">
                <h3>Edit Project</h3>
                <input type="hidden" id="edit-ProjectID" name="ProjectID">
                <label for="edit-Name_of_Project">Name:</label>
                <input type="text" id="edit-Name_of_Project" name="Name_of_Project">
                <label for="edit-address">Address:</label>
                <input type="text" id="edit-address" name="address">
                <label for="edit-budget">Budget:</label>
                <input type="text" id="edit-budget" name="budget">
                <button type="submit">Save Changes</button>
            </form>
        </div>
    </div>

    <script>
        const addressLinks = {
            "Augmentation of incubation space":"https://stpi.in/en/patna",
            "Centre of Excellence (CoE) for Automotive Electronics": "https://stpi.in/en/about-stpi-pune",
            "CoE for IoT in Agriculture":"https://stpi.in/en/centre-of-entrepreneurship/fasal",
            "CoE on Industry 4.0 ":"https://stpi.in/en/centre-of-entrepreneurship/kalpataru",
            "Centre of Excellence with Startup innovation zone (CoESIZ)in NER phase-1 ":"https://guwahati.stpi.in/",
            '"Neuron"-A_CoE_in_AI/data_analytics,IoT_and_AVG':"https://stpi.in/en/mohali"
        };

        // Function to fetch and populate projects
        fetch('http://localhost/startup/fetch_all.php')
            .then(response => response.json())
            .then(data => {
                console.log('Data fetched from API:', data);

                // Filter projects with ProjectID equal to '1'
                const projects = data.projects.filter(proj => proj.ProjectID === '1');
                console.log('Filtered projects:', projects);

                // Populate the table with filtered projects
                const tableBody = document.getElementById('project-data');
                projects.forEach(project => {
                    const address = project.Address;
                    console.log(`Processing project: ${project.Name_of_Project}`);
                    const addressLink = addressLinks[project.Name_of_Project]
                        ? `<a href="${addressLinks[project.Name_of_Project]}" target="_blank">${address}</a>`
                        : address;

                    console.log(`Address link for ${project.Name_of_Project}: ${addressLink}`);
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td><a href="project_details.php?projectName=${encodeURIComponent(project.Name_of_Project)}">${project.Name_of_Project}</a></td>
                        <td>${addressLink}</td>
                        <td>${project.Budget || ''}</td>
                        <td>
                            <button class="edit-btn" data-id="${project.ID}">Edit</button>
                        </td>
                    `;
                    row.setAttribute('data-id', project.ID);
                    tableBody.appendChild(row);

                    // Add event listener for the edit button
                    row.querySelector('.edit-btn').addEventListener('click', function() {
                        openEditModal(project);
                    });
                });
            })
            .catch(error => console.error('Error fetching data:', error));
        
        // Modal handling for add project
       const addModal = document.getElementById('add-modal');
        const editModal = document.getElementById('edit-modal');
        const addBtn = document.getElementById('add-project-btn');
        const deleteBtn = document.getElementById('delete-project-btn');
        const closeAddModal = document.querySelector('#add-modal .close');
        const closeEditModal = document.querySelector('#edit-modal .close');

        addBtn.onclick = function() {
            addModal.style.display = 'block';
        }

        closeAddModal.onclick = function() {
            addModal.style.display = 'none';
        }

        closeEditModal.onclick = function() {
            editModal.style.display = 'none';
        }

        window.onclick = function(event) {
            if (event.target === addModal) {
                addModal.style.display = 'none';
            }
            if (event.target === editModal) {
                editModal.style.display = 'none';
            }
        }

        // Add Project Form Submission
        document.getElementById('add-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            // Check if budget field is empty or not provided
            const budget = formData.get('budget') || ''; // Default to empty string if budget is not provided

            fetch('http://localhost/startup/create.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log('Server response:', data);

                if (data.id) {
                    const name = formData.get('Name_of_Project');
                    const address = formData.get('address');
                    const addressLink = addressLinks[name]
                        ? `<a href="${addressLinks[name]}" target="_blank">${address}</a>`
                        : address;

                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td><a href="project_details.php?projectName=${encodeURIComponent(name)}">${name}</a></td>
                        <td>${addressLink}</td>
                        <td>${budget}</td>
                        <td>
                            <button class="edit-btn" data-id="${data.id}">Edit</button>
                        </td>
                    `;
                    document.getElementById('project-data').appendChild(row);

                    // Add event listener for the new edit button
                    row.querySelector('.edit-btn').addEventListener('click', function() {
                        openEditModal({
                            ID: data.id,
                            Name_of_Project: name,
                            Address: address,
                            Budget: budget
                        });
                    });

                    this.reset(); // Reset the form
                    addModal.style.display = 'none'; // Hide the modal
                } else {
                    console.error('Error adding project:', data.error || 'Unknown error');
                    alert('Error adding project. Please try again later.');
                }
            })
            .catch(error => {
                console.error('Error adding project:', error);
                alert('Error adding project. Please try again later.');
            });
        });

        function openEditModal(project) {
            document.getElementById('edit-ProjectID').value = project.ID;
            document.getElementById('edit-Name_of_Project').value = project.Name_of_Project;
            document.getElementById('edit-address').value = project.Address;
            document.getElementById('edit-budget').value = project.Budget;
            editModal.style.display = 'block';
        }

        // Edit Project Form Submission
        document.getElementById('edit-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            fetch('http://localhost/startup/update.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log('Server response:', data);

                if (data.success) {
                    const updatedProject = {
                        ID: formData.get('ProjectID'),
                        Name_of_Project: formData.get('Name_of_Project'),
                        Address: formData.get('address'),
                        Budget: formData.get('budget')
                    };

                    // Update the specific project row in the table
                    const rows = document.querySelectorAll(`#project-data tr`);
                    rows.forEach(row => {
                        if (row.getAttribute('data-id') === updatedProject.ID) {
                            const addressLink = addressLinks[updatedProject.Name_of_Project]
                                ? `<a href="${addressLinks[updatedProject.Name_of_Project]}" target="_blank">${updatedProject.Address}</a>`
                                : updatedProject.Address;

                            row.innerHTML = `
                                <td><a href="project_details.php?projectName=${encodeURIComponent(updatedProject.Name_of_Project)}">${updatedProject.Name_of_Project}</a></td>
                                <td>${addressLink}</td>
                                <td>${updatedProject.Budget || ''}</td>
                                <td>
                                    <button class="edit-btn" data-id="${updatedProject.ID}">Edit</button>
                                </td>
                            `;

                            // Add event listener for the updated edit button
                            row.querySelector('.edit-btn').addEventListener('click', function() {
                                openEditModal(updatedProject);
                            });
                        }
                    });

                    editModal.style.display = 'none'; // Hide the edit modal
                } else {
                    console.error('Error updating project:', data.error || 'Unknown error');
                    alert('Error updating project. Please try again later.');
                }
            })
            .catch(error => {
                console.error('Error updating project:', error);
                alert('Error updating project. Please try again later.');
            });
        });

        // Delete Mode
        let deleteMode = false;

        deleteBtn.addEventListener('click', function() {
            deleteMode = !deleteMode;
            const projectRows = document.querySelectorAll('#project-data tr');
            
            if (deleteMode) {
                this.textContent = 'Cancel Delete';
                projectRows.forEach(row => {
                    row.classList.add('delete-mode');
                    row.addEventListener('click', selectRowToDelete);
                });
            } else {
                this.textContent = 'Delete Project';
                projectRows.forEach(row => {
                    row.classList.remove('delete-mode');
                    row.removeEventListener('click', selectRowToDelete);
                });
            }
        });

        function selectRowToDelete(event) {
            const row = event.currentTarget;
            const projectName = row.querySelector('td:first-child').textContent.trim();
            if (confirm(`Are you sure you want to delete the project "${projectName}"?`)) {
                deleteProject(projectName);
            }
        }

        function deleteProject(projectName) {
            fetch('http://localhost/startup/delete.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ name: projectName })
            })
            .then(response => response.json())
            .then(data => {
                console.log('Server response:', data);
                if (data.success) {
                    // Remove the deleted project row from the table
                    document.querySelectorAll('#project-data tr').forEach(row => {
                        if (row.querySelector('td:first-child').textContent.trim() === projectName) {
                            row.remove();
                        }
                    });
                } else {
                    console.error('Error deleting project:', data.message);
                    alert('Error deleting project. Please try again later.');
                }
            })
            .catch(error => console.error('Error deleting project:', error));
        }
    </script>
    <script src="include.js"></script>
</body>
</html>


