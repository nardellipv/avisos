<div class="modal fade" id="contactAdvertiser" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <h4 class="modal-title"><i class=" icon-mail-2"></i> Mensaje a {{ $service->user->name }} </h4>
            </div>
            <div class="modal-body">
                <form role="form" action="{{ route('message.send') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="recipient-name" class="control-label">Nombre:</label>
                        <input class="form-control required" id="recipient-name" placeholder="Tu Nombre"
                               data-placement="top" data-trigger="manual" name="name" required value="{{ old('name') }}"
                               type="text">
                    </div>
                    <div class="form-group">
                        <label for="sender-email" class="control-label">E-mail:</label>
                        <input id="sender-email" type="text" name="email" data-trigger="manual" required value="{{ old('email') }}"
                               data-placement="top" placeholder="email@you.com" class="form-control email">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="control-label">Mensaje <span class="text-count">(200) </span>:</label>
                        <textarea class="form-control" id="message-text" placeholder="Tu mensaje aquí" name="messageService"
                                  data-placement="top" data-trigger="manual">{{ old('messageService') }}</textarea>

                                  <input name="serviceUser" value="{{ $service->id }}" required readonly hidden>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success pull-right">Enviar Mensaje</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>