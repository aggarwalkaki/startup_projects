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
    <title>Project Details</title>

    <style>
      
            /* CSS for the modal popup */
            .modal {
                display: none; /* Hidden by default */
                position: fixed; /* Stay in place */
                z-index: 1; /* Sit on top */
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto; /* Enable scroll if needed */
                background-color: rgba(0, 0, 0, 0.4); /* Black with opacity */
            }
        
            .modal-content {
                background-color: #fefefe;
                margin: 10% auto; /* 10% from the top and centered horizontally */
                padding: 20px;
                border: 1px solid #888;
                width: 60%; /* Set the width of the modal */
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                border-radius: 8px; /* Rounded corners */
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
        
            /* Style for form elements within the modal */
            #edit-form label {
                display: block;
                margin-bottom: 8px;
            }
        
            #edit-form input[type="text"] {
                width: calc(100% - 20px); /* Full width minus padding */
                padding: 8px;
                margin-bottom: 15px;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
            }
        
            #edit-form button[type="submit"] {
                background-color: #4CAF50;
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }
        
            #edit-form button[type="submit"]:hover {
                background-color: #45a049;
            }
        </style>
    
    <link rel="stylesheet" href="newstyles.css">
</head>
<body>
    <div id="header-container"></div>
    <div id="nav-container"></div>
    <table>
        <thead>
            <tr>
                <th>Name of Project</th>
                <th>Address</th>
                <th>Implementing Agency</th>
                <th>Project Objectives</th>
                <th>Areas of Technology Develop</th>
                <th>Budget</th>
                <th>Funds To Be Released</th>
                <th>Funds Released</th>
                <th>No of Startup Incubated</th>
                <th>PRSG Dates</th>
                <th>Project Approval Date</th>
                <th>Project Deadline</th>
                <th>Project Duration</th>
                <th>Total Investment Generated</th>
                <th>Total Outlay</th>
                <th>Action Taken</th>
                <th>Outcome So Far</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="project-data">
            <!-- Data will be inserted here -->
        </tbody>
    </table>

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
                <label for="edit-Implementing_Agency">Implementing Agency:</label>
                <input type="text" id="edit-Implementing_Agency" name="Implementing_Agency">
                <label for="edit-Project_Objectives">Project Objectives:</label>
                <input type="text" id="edit-Project_Objectives" name="Project_Objectives">
                <label for="edit-Areas_of_Technology_Develop">Areas of Technology Develop:</label>
                <input type="text" id="edit-Areas_of_Technology_Develop" name="Areas_of_Technology_Develop">
                <label for="edit-budget">Budget:</label>
                <input type="text" id="edit-budget" name="budget">
                <label for="edit-FundsToBeReleased">Funds To Be Released:</label>
                <input type="text" id="edit-FundsToBeReleased" name="FundsToBeReleased">
                <label for="edit-Funds_Released">Funds Released:</label>
                <input type="text" id="edit-Funds_Released" name="Funds_Released">
                <label for="edit-No_of_Startup_Incubated">No of Startup Incubated:</label>
                <input type="text" id="edit-No_of_Startup_Incubated" name="No_of_Startup_Incubated">
                <label for="edit-PRSGDates">PRSG Dates:</label>
                <input type="text" id="edit-PRSGDates" name="PRSGDates">
                <label for="edit-Project_Approval_Date">Project Approval Date:</label>
                <input type="text" id="edit-Project_Approval_Date" name="Project_Approval_Date">
                <label for="edit-Project_Deadline">Project Deadline:</label>
                <input type="text" id="edit-Project_Deadline" name="Project_Deadline">
                <label for="edit-Project_Duration">Project Duration:</label>
                <input type="text" id="edit-Project_Duration" name="Project_Duration">
                <label for="edit-Total_Investment_Generated">Total Investment Generated:</label>
                <input type="text" id="edit-Total_Investment_Generated" name="Total_Investment_Generated">
                <label for="edit-Total_Outlay">Total Outlay:</label>
                <input type="text" id="edit-Total_Outlay" name="Total_Outlay">
                <label for="edit-ActionTaken">Action Taken:</label>
                <input type="text" id="edit-ActionTaken" name="ActionTaken">
                <label for="edit-outcome_so_far">Outcome So Far:</label>
                <input type="text" id="edit-outcome_so_far" name="outcome_so_far">
                <button type="submit">Save Changes</button>
            </form>
        </div>
    </div>

    <script>
        // Get the project name from the URL parameters and decode it
        const urlParams = new URLSearchParams(window.location.search);
        const projectName = urlParams.get('projectName');

        // Check if the projectName is valid
        if (!projectName) {
            const row = document.createElement('tr');
            row.innerHTML = `<td colspan="18">Invalid project name</td>`;
            document.getElementById('project-data').appendChild(row);
        } else {
            fetch('http://localhost/startup/fetch_all.php')
                .then(response => response.json())
                .then(data => {
                    console.log('Data fetched from API:', data);

                    // Find the project with the given project name
                    const project = data.projects.find(proj => proj.Name_of_Project === projectName);

                    if (project) {
                        // Display project details in a table
                        const tableBody = document.getElementById('project-data');
                        const row = document.createElement('tr');
                        row.setAttribute('data-id', project.ID); // Set data-id attribute to identify the project
                        row.innerHTML = `
                            <td>${project.Name_of_Project || ''}</td>
                            <td>${project.Address || ''}</td>
                            <td>${project.Implementing_Agency || ''}</td>
                            <td>${project.Project_Objectives || ''}</td>
                            <td>${project.Areas_of_Technology_Develop || ''}</td>
                            <td>${project.Budget || ''}</td>
                            <td>${project.FundsToBeReleased || ''}</td>
                            <td>${project.Funds_Released || ''}</td>
                            <td>${project.No_of_Startup_Incubated || ''}</td>
                            <td>${project.PRSGDates || ''}</td>
                            <td>${project.Project_Approval_Date || ''}</td>
                            <td>${project.Project_Deadline || ''}</td>
                            <td>${project.Project_Duration || ''}</td>
                            <td>${project.Total_Investment_Generated || ''}</td>
                            <td>${project.Total_Outlay || ''}</td>
                            <td>${project.ActionTaken || ''}</td>
                            <td>${project.outcome_so_far || ''}</td>
                            <td>
                                <button class="edit-btn" data-id="${project.ID}">Edit</button>
                            </td>
                        `;
                        tableBody.appendChild(row);

                        // Add event listener for the edit button
                        row.querySelector('.edit-btn').addEventListener('click', function() {
                            openEditModal(project);
                        });
                    } else {
                        // Handle case when no project is found with the given project name
                        const row = document.createElement('tr');
                        row.innerHTML = `<td colspan="18">No project found with name ${projectName}</td>`;
                        document.getElementById('project-data').appendChild(row);
                    }
                })
                .catch(error => console.error('Error fetching data:', error));
        }

        // Edit modal functionality
        const editModal = document.getElementById('edit-modal');
        const closeEditModal = document.querySelector('#edit-modal .close');
        closeEditModal.onclick = function() {
            editModal.style.display = 'none';
        };

        window.onclick = function(event) {
            if (event.target === editModal) {
                editModal.style.display = 'none';
            }
        };

        function openEditModal(project) {
            document.getElementById('edit-ProjectID').value = project.ID;
            document.getElementById('edit-Name_of_Project').value = project.Name_of_Project || '';
            document.getElementById('edit-address').value = project.Address || '';
            document.getElementById('edit-Implementing_Agency').value = project.Implementing_Agency || '';
            document.getElementById('edit-Project_Objectives').value = project.Project_Objectives || '';
            document.getElementById('edit-Areas_of_Technology_Develop').value = project.Areas_of_Technology_Develop || '';
            document.getElementById('edit-budget').value = project.Budget || '';
            document.getElementById('edit-FundsToBeReleased').value = project.FundsToBeReleased || '';
            document.getElementById('edit-Funds_Released').value = project.Funds_Released || '';
            document.getElementById('edit-No_of_Startup_Incubated').value = project.No_of_Startup_Incubated || '';
            document.getElementById('edit-PRSGDates').value = project.PRSGDates || '';
            document.getElementById('edit-Project_Approval_Date').value = project.Project_Approval_Date || '';
            document.getElementById('edit-Project_Deadline').value = project.Project_Deadline || '';
            document.getElementById('edit-Project_Duration').value = project.Project_Duration || '';
            document.getElementById('edit-Total_Investment_Generated').value = project.Total_Investment_Generated || '';
            document.getElementById('edit-Total_Outlay').value = project.Total_Outlay || '';
            document.getElementById('edit-ActionTaken').value = project.ActionTaken || '';
            document.getElementById('edit-outcome_so_far').value = project.outcome_so_far || '';

            editModal.style.display = 'block';
        }

        // Handle form submission for editing project details
        document.getElementById('edit-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            fetch('http://localhost/startup/process_update.php', {
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
                        Implementing_Agency: formData.get('Implementing_Agency'),
                        Project_Objectives: formData.get('Project_Objectives'),
                        Areas_of_Technology_Develop: formData.get('Areas_of_Technology_Develop'),
                        Budget: formData.get('budget'),
                        FundsToBeReleased: formData.get('FundsToBeReleased'),
                        Funds_Released: formData.get('Funds_Released'),
                        No_of_Startup_Incubated: formData.get('No_of_Startup_Incubated'),
                        PRSGDates: formData.get('PRSGDates'),
                        Project_Approval_Date: formData.get('Project_Approval_Date'),
                        Project_Deadline: formData.get('Project_Deadline'),
                        Project_Duration: formData.get('Project_Duration'),
                        Total_Investment_Generated: formData.get('Total_Investment_Generated'),
                        Total_Outlay: formData.get('Total_Outlay'),
                        ActionTaken: formData.get('ActionTaken'),
                        outcome_so_far: formData.get('outcome_so_far')
                    };

                    // Update the specific project row in the table
                    const rows = document.querySelectorAll(`#project-data tr`);
                    rows.forEach(row => {
                        if (row.getAttribute('data-id') === updatedProject.ID) {
                            row.innerHTML = `
                                <td>${updatedProject.Name_of_Project || ''}</td>
                                <td>${updatedProject.Address || ''}</td>
                                <td>${updatedProject.Implementing_Agency || ''}</td>
                                <td>${updatedProject.Project_Objectives || ''}</td>
                                <td>${updatedProject.Areas_of_Technology_Develop || ''}</td>
                                <td>${updatedProject.Budget || ''}</td>
                                <td>${updatedProject.FundsToBeReleased || ''}</td>
                                <td>${updatedProject.Funds_Released || ''}</td>
                                <td>${updatedProject.No_of_Startup_Incubated || ''}</td>
                                <td>${updatedProject.PRSGDates || ''}</td>
                                <td>${updatedProject.Project_Approval_Date || ''}</td>
                                <td>${updatedProject.Project_Deadline || ''}</td>
                                <td>${updatedProject.Project_Duration || ''}</td>
                                <td>${updatedProject.Total_Investment_Generated || ''}</td>
                                <td>${updatedProject.Total_Outlay || ''}</td>
                                <td>${updatedProject.ActionTaken || ''}</td>
                                <td>${updatedProject.outcome_so_far || ''}</td>
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
    </script>
    <script src="include.js"></script>
</body>
</html>
