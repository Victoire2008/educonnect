<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une Filière</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --blue: #0d6efd;
            --light-blue: #e9f2ff;
            --white: #ffffff;
            --text-dark: #1b1b1b;
        }

        body {
            background-color: var(--light-blue);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px;
        }

        h2 {
            color: var(--blue);
            font-weight: 600;
            text-align: center;
        }

        .card {
            background-color: var(--white);
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            max-width: 600px;
            margin: 40px auto;
            padding: 25px;
        }

        label {
            font-weight: 500;
            color: var(--text-dark);
        }

        .form-control, textarea {
            border-radius: 8px;
        }

        .btn-primary {
            background-color: var(--blue);
            border: none;
            border-radius: 8px;
            width: 50%;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
        }

        .btn-secondary {
            border-radius: 8px;
            width: 30%;
            margin-top: 10px;
        }

        .alert {
            border-radius: 8px;
            text-align: center;
        }

        /* --- Responsive Design --- */
        @media (max-width: 768px) {
            .card {
                max-width: 90%;
                padding: 20px;
            }

            h2 {
                font-size: 1.5rem;
            }

            .btn-primary, .btn-secondary {
                font-size: 0.9rem;
                padding: 5px;
            }

            .d-flex {
                flex-direction: initial;
                gap: 10px;
            }
        }

        @media (max-width: 480px) {
            h2 {
                font-size: 1.3rem;
            }

            .card {
                padding: 15px;
            }

            label {
                font-size: 0.9rem;
            }

            .form-control {
                font-size: 0.9rem;
            }

            .btn-primary, .btn-secondary {
                font-size: 0.85rem;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Modifier une Filière</h2>

        @if(session('success'))
            <div class="alert alert-success mt-3">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.updateFiliere', $filiere->id) }}" method="POST" class="card">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nom" class="form-label">Nom de la filière</label>
                <input type="text" name="nom" id="nom" class="form-control" 
                       value="{{ old('nom', $filiere->nom) }}" required>
                @error('nom') 
                    <small class="text-danger">{{ $message }}</small> 
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $filiere->description) }}</textarea>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">⬅ Retour</a>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
    </div>
</body>
</html>
