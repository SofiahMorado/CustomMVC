<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Client List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <h1 class="mb-4">This is A Client List</h1>
            </div>
            <div class="col">
                <button type="button" class="btn btn-outline-primary me-2 mb-4 float-end" data-bs-toggle="modal" data-bs-target="#addClientModal">
                    <i class="fa-solid fa-circle-plus fa-2x"></i> <!-- Add icon -->
                </button>
            </div>
        </div>
        
        <?php if (!empty($data['clients'])): ?>
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Last Name</th>
                        <th>Contact</th>
                        <th>Address</th>
                        <th>Gender</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['clients'] as $client): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($client['firstname']); ?></td>
                            <td><?php echo htmlspecialchars($client['middlename']); ?></td>
                            <td><?php echo htmlspecialchars($client['lastname']); ?></td>
                            <td><?php echo htmlspecialchars($client['contact']); ?></td>
                            <td><?php echo htmlspecialchars($client['address']); ?></td>
                            <td><?php echo htmlspecialchars($client['gender']); ?></td>
                            <td><?php echo htmlspecialchars($client['client_status']); ?></td>
                            <td class="text-center">
                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editClientModal<?php echo $client['client_id']; ?>">
                                        <i class="fa-solid fa-pencil"></i> <!-- Edit icon -->
                                    </button>

                                    <form action="/CustomMVC/public/home/deleteClient" method="POST">
                                        <input type="hidden" name="client_id" value="<?php echo $client['client_id']; ?>">
                                        <button type="submit" class="btn btn-outline-danger">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal for editing client -->
                        <div class="modal fade" id="editClientModal<?php echo $client['client_id']; ?>" tabindex="-1" aria-labelledby="editClientModalLabel<?php echo $client['client_id']; ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editClientModalLabel<?php echo $client['client_id']; ?>">Edit Client</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="/CustomMVC/public/home/updateClient" method="POST">
                                            <input type="hidden" name="client_id" value="<?php echo $client['client_id']; ?>">
                                            <div class="mb-3">
                                                <label for="firstname<?php echo $client['client_id']; ?>" class="form-label">First Name</label>
                                                <input type="text" class="form-control" id="firstname<?php echo $client['client_id']; ?>" name="firstname" value="<?php echo htmlspecialchars($client['firstname']); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="middlename<?php echo $client['client_id']; ?>" class="form-label">Middle Name</label>
                                                <input type="text" class="form-control" id="middlename<?php echo $client['client_id']; ?>" name="middlename" value="<?php echo htmlspecialchars($client['middlename']); ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="lastname<?php echo $client['client_id']; ?>" class="form-label">Last Name</label>
                                                <input type="text" class="form-control" id="lastname<?php echo $client['client_id']; ?>" name="lastname" value="<?php echo htmlspecialchars($client['lastname']); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="contact<?php echo $client['client_id']; ?>" class="form-label">Contact</label>
                                                <input type="text" class="form-control" id="contact<?php echo $client['client_id']; ?>" name="contact" value="<?php echo htmlspecialchars($client['contact']); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="address<?php echo $client['client_id']; ?>" class="form-label">Address</label>
                                                <input type="text" class="form-control" id="address<?php echo $client['client_id']; ?>" name="address" value="<?php echo htmlspecialchars($client['address']); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="gender<?php echo $client['client_id']; ?>" class="form-label">Gender</label>
                                                <select class="form-select" id="gender<?php echo $client['client_id']; ?>" name="gender" required>
                                                    <option value="Male" <?php echo ($client['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                                                    <option value="Female" <?php echo ($client['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                                                    <option value="Other" <?php echo ($client['gender'] == 'Other') ? 'selected' : ''; ?>>Other</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="client_status<?php echo $client['client_id']; ?>" class="form-label">Status</label>
                                                <input type="text" class="form-control" id="client_status<?php echo $client['client_id']; ?>" name="client_status" value="<?php echo htmlspecialchars($client['client_status']); ?>" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No Clients found.</p>
        <?php endif; ?>

        <!-- Modal for adding a new client -->
        <div class="modal fade" id="addClientModal" tabindex="-1" aria-labelledby="addClientModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addClientModalLabel">Add New Client</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/CustomMVC/public/home/addClient" method="POST">
                            <div class="mb-3">
                                <label for="firstname" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstname" name="firstname" required>
                            </div>
                            <div class="mb-3">
                                <label for="middlename" class="form-label">Middle Name</label>
                                <input type="text" class="form-control" id="middlename" name="middlename">
                            </div>
                            <div class="mb-3">
                                <label for="lastname" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastname" name="lastname" required>
                            </div>
                            <div class="mb-3">
                                <label for="contact" class="form-label">Contact</label>
                                <input type="text" class="form-control" id="contact" name="contact" required>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address" required>
                            </div>
                            <div class="mb-3">
                                <label for="gender" class="form-label">Gender</label>
                                <select class="form-select" id="gender" name="gender" required>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="client_status" class="form-label">Status</label>
                                <input type="text" class="form-control" id="client_status" name="client_status" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Client</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
