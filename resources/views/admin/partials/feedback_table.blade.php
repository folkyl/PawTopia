@if($feedbacks->count() > 0)
    <table class="feedback-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Feedback</th>
                <th>Date</th>
                <th>Rating</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="feedbackTableBody">
            @foreach($feedbacks as $index => $feedback)
                <tr data-rating="{{ $feedback->rating }}" data-id="{{ $feedback->id }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <div class="feedback-text">{{ $feedback->message }}</div>
                        @if($feedback->user_name)
                            <div class="feedback-user">- {{ $feedback->user_name }}</div>
                        @endif
                    </td>
                    <td>
                        <div class="date-display">{{ $feedback->created_at->format('M d, Y') }}</div>
                    </td>
                    <td>
                        <div class="rating-display">
                            <div class="rating-score">{{ $feedback->rating }}/5</div>
                            <div class="star-rating">
                                @for($i = 1; $i <= 5; $i++)
                                    <span class="star {{ $i <= $feedback->rating ? 'filled' : '' }}">★</span>
                                @endfor
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <button class="action-btn btn-reply" onclick="editFeedback({{ $feedback->id }}, '{{ addslashes($feedback->message) }}', {{ $feedback->rating }})">
                                <i class="bi bi-pencil"></i> Edit
                            </button>
                            <button class="action-btn btn-delete" onclick="deleteFeedback({{ $feedback->id }})">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <div class="no-feedback-message text-center py-4">
        <i class="bi bi-inbox" style="font-size: 2rem; color: #8B7355; margin-bottom: 1rem;"></i>
        <p class="mb-0">No feedback has been submitted yet.</p>
    </div>
@endif
