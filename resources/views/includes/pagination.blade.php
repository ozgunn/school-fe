@if ($pagination['total'] > 0)
    <div class="d-flex justify-content-between align-items-center mb-3">
        <nav aria-label="Page navigation">
            <ul class="pagination">
                @if ($pagination['current_page'] > 1)
                    <li class="page-item">
                        <a class="page-link" href="{{ $pagination['prev_page_url'] }}" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link" aria-hidden="true">&laquo;</span>
                    </li>
                @endif

                @for ($i = max(1, $pagination['current_page'] - 5); $i <= min($pagination['last_page'], $pagination['current_page'] + 5); $i++)
                    <li class="page-item {{ $pagination['current_page'] == $i ? 'active' : '' }}">
                        <a class="page-link" href="{{ $pagination['path'] }}?page={{ $i }}">{{ $i }}</a>
                    </li>
                @endfor

                @if ($pagination['current_page'] < $pagination['last_page'])
                    <li class="page-item">
                        <a class="page-link" href="{{ $pagination['next_page_url'] }}" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link" aria-hidden="true">&raquo;</span>
                    </li>
                @endif
            </ul>
        </nav>

        <span class="text-muted">Toplam {{ $pagination['total'] }} kayıt</span>
    </div>
@endif
