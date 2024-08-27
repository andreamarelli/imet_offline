@if($mode === \AndreaMarelli\ModularForms\Enums\ModuleViewModes::EDIT)
    @include('modular-forms::module.components.bars.save', compact(['controller', 'definitions', 'records', 'mode']))
@endif
