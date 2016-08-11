<?php
/* <one line to give the program's name and a brief idea of what it does.>
 * Copyright (C) 2015 ATM Consulting <support@atm-consulting.fr>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * \file    class/actions_simulation.class.php
 * \ingroup simulation
 * \brief   This file is an example hook overload class file
 *          Put some comments here
 */

/**
 * Class Actionssimulation
 */
class Actionssimulation
{
	/**
	 * @var array Hook results. Propagated to $hookmanager->resArray for later reuse
	 */
	public $results = array();

	/**
	 * @var string String displayed by executeHook() immediately after return
	 */
	public $resprints;

	/**
	 * @var array Errors
	 */
	public $errors = array();

	/**
	 * Constructor
	 */
	public function __construct()
	{
	}

	/**
	 * Overloading the doActions function : replacing the parent's function with the one below
	 *
	 * @param   array()         $parameters     Hook metadatas (context, etc...)
	 * @param   CommonObject    &$object        The object to process (an invoice if you are in invoice module, a propale in propale's module, etc...)
	 * @param   string          &$action        Current action (if set). Generally create or edit or null
	 * @param   HookManager     $hookmanager    Hook manager propagated to allow calling another hook
	 * @return  int                             < 0 on error, 0 on success, 1 to replace standard code
	 */
	function doActions($parameters, &$object, &$action, $hookmanager)
	{
	}
	
	function formObjectOptions($parameters, &$object, &$action, $hookmanager)
	{
		if ($parameters['currentcontext'] == 'propalcard' && $action == 'create')
		{
			$simulation = GETPOST('simulation', 'int');
			if ($simulation)
			{
				print '<input type="hidden" name="simulation" value="1" />';
				
				?>
					<script type="text/javascript">
						$(function() {
							$('#options_is_simulation option[value=1]').prop('selected', true);
						});
					</script>
				<?php
			}
		}
	}

	function addMoreActionsButtons($parameters, &$object, &$action, $hookmanager)
	{
		if ($parameters['currentcontext'] == 'commcard')
		{
			print '
			<script type="text/javascript">
				$(function() {
					var simulation_html_bt_create = $(\'<div class="inline-block divButAction"><a href="'.dol_buildpath('/comm/propal.php?socid='.$object->id.'&amp;action=create&simulation=1', 1).'" class="butAction">Créer une simulation</a></div>\');
														
					$(".tabsAction").prepend(simulation_html_bt_create);
				});
			</script>';
		}
	}
}