<div class="card-body">
    <div class="settings-integrations row">
        <div class="col-lg-4">
            <div class="settings-integrations-item">
                <div class="settings-integrations-item-info">
                    <h4>Division</h4>
                </div>
                <div class="settings-integrations-item-switcher">
                    <div class="form-check form-switch">
                        <input class="form-check-input form-control-md" wire:click="changeBool('division_enabled')"
                               type="checkbox"
                               id="settingsIntegrationOneSwitcher" {{ get_setting('division_enabled') ? 'checked' : '' }}>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
