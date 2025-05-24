<div class="card shadow">
    <div class="card-body">
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $client->name ?? '') }}" required>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $client->email ?? '') }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Contact Person</label>
                <input type="text" name="contact_person" class="form-control" 
                       value="{{ old('contact_person', $client->contact_person ?? '') }}" required>
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">{{ isset($client) ? 'Update' : 'Create' }}</button>
            <a href="{{ route('clients.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </div>
</div>