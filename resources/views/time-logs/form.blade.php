<div class="card shadow">
    <div class="card-body">
        <div class="mb-3">
            <label class="form-label">Project</label>
            <select name="project_id" class="form-select" required>
                @foreach($projects as $project)
                    <option value="{{ $project->id }}" {{ old('project_id', $timeLog->project_id ?? '') == $project->id ? 'selected' : '' }}>
                        {{ $project->title }} ({{ $project->client->name }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Start Time</label>
                <input type="datetime-local" name="start_time" class="form-control" 
                       value="{{ old('start_time', isset($timeLog) ? $timeLog->start_time->format('Y-m-d\TH:i') : '' }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">End Time</label>
                <input type="datetime-local" name="end_time" class="form-control" 
                       value="{{ old('end_time', isset($timeLog) ? $timeLog->end_time->format('Y-m-d\TH:i') : '' }}" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3">{{ old('description', $timeLog->description ?? '') }}</textarea>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">{{ isset($timeLog) ? 'Update' : 'Create' }}</button>
            <a href="{{ route('time-logs.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </div>
</div>