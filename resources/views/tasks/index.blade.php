<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Daftar Tugas</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body>

<div class="container mt-5">

    <h1 class="mb-4">Daftar Tugas</h1>

    <!-- FORM TAMBAH TUGAS -->
    <form action="/tasks" method="POST" class="mb-4">
        @csrf

        <div class="input-group">
            <input
                type="text"
                name="title"
                class="form-control"
                placeholder="Masukkan tugas ..."
            >

            <button type="submit" class="btn btn-primary">
                Tambah
            </button>
        </div>

        @error('title')
            <div class="text-danger mt-2">
                {{ $message }}
            </div>
        @enderror
    </form>


    <!-- DAFTAR TUGAS -->

    @if ($tasks->count() > 0)

        @foreach ($tasks as $task)

            <div class="card mb-2">

                <div class="card-body d-flex justify-content-between align-items-center">

                    <!-- NAMA DAN STATUS -->
                    <div>

                        @if ($task->status == 1)

                            <span class="text-decoration-line-through text-muted">
                                {{ $task->title }}
                            </span>

                            <span class="badge bg-success ms-2">
                                Selesai
                            </span>

                        @else

                            <span>
                                {{ $task->title }}
                            </span>

                            <span class="badge bg-secondary ms-2">
                                Belum selesai
                            </span>

                        @endif

                    </div>


                    <!-- BUTTON -->
                    <div>

                        @if ($task->status == 0)

                            <form
                                action="/tasks/{{ $task->id }}/status"
                                method="POST"
                                class="d-inline"
                            >
                                @csrf
                                @method('PATCH')

                                <button
                                    type="submit"
                                    class="btn btn-success btn-sm"
                                >
                                    Selesai
                                </button>
                            </form>

                        @endif


                        <form
                            action="/tasks/{{ $task->id }}"
                            method="POST"
                            class="d-inline"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="btn btn-danger btn-sm"
                            >
                                Hapus
                            </button>
                        </form>

                    </div>

                </div>

            </div>

        @endforeach

    @else

        <div class="alert alert-info">
            Belum ada tugas.
        </div>

    @endif

</div>

</body>
</html>