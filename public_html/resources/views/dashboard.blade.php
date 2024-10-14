<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('PROFILE') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            @if (auth()->user()->photo_path)
                                <img src="{{ asset('storage/' . auth()->user()->photo_path) }}" alt="User Photo"
                                    class="mx-auto d-block mb-4 rounded-circle" style="max-width: 200px;">
                            @else
                                <img src="{{ asset('storage/photos/Default_Photo.svg') }}" alt="Default User Photo"
                                    class="mx-auto d-block mb-4 rounded-circle" style="max-width: 200px;">
                            @endif
                            <div class="text-gray-900" style="padding: 30px">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <td class="font-weight-bold">Name</td>
                                            <td>{{ auth()->user()->name }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">NIK:</td>
                                            <td>{{ auth()->user()->nik ?? 'Not provided' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">NIP:</td>
                                            <td>{{ auth()->user()->nip ?? 'Not provided' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">TTL:</td>
                                            <td>{{ auth()->user()->ttl ?? 'Not provided' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Phone:</td>
                                            <td>{{ auth()->user()->phone ?? 'Not provided' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Email:</td>
                                            <td>{{ auth()->user()->email }}</td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Subject:</td>
                                            <td>
                                                @if (auth()->user()->subject_id)
                                                    {{ \App\Models\Subject::find(auth()->user()->subject_id)->name }}
                                                @else
                                                    Not provided
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Role:</td>
                                            <td>{{ auth()->user()->role }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <p class="mt-4 text-center text-danger">*Jika ingin merubah profile, tekan tab yang berisi nama Anda lalu tekan tab Profile.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
